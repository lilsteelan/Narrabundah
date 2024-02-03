// All code including essentials.h was 
// written by Stellan Lindrud
// Credit to YWROBOT for I2C library
#include <SoftwareSerial.h>
#include <Servo.h>
#include "essentials.h"
// Essentials.h includes a class object called feeder
// And its referenced using the feeder.paramater_you_want_to_access
// Code is object orientated referencing the class the class that you want to use
// Use of both private and public variables as well as superglobals

//Initialisations
SoftwareSerial hc06(2,3); //Initialisation of HC06 module and pins
Servo petfeeder;  // Initialise Servo

// GLOBAL VARIABLES
String date = "";

//Time acceleration of the module
// 1 is standard time 1 minute = 1 minute
// 60 is 60 times faster eg 1 minute = 1 second
int timeAcceleration;

unsigned long timeSinceStart;
int minutes;
int hours;
int previousHour;
bool timeHasBeenObtained = false;
float timeSinceLastCheck = 0;
int feeds = 0;
int initialMinutes;
int initialHours;
int feedingTime;
int elapsedMinutes;
int elapsedHours;
String alarm = "";
bool feedingTimeAdded = false;
unsigned long previousMillis = 0;    // Previous time
int servoPin = 4;  
int buzzer = 9;

// The time class holds all the time related functions
class Time{
  public:
    static void releaseFood(){
        //Rotate Servo
        feeds++;
        petfeeder.write(0);
        //Show that its feeding time on LCD Display
        feeder.feedLCD();
        tone(9, 3000);
        delay(100);
        noTone(9);
        delay(50);
        tone(9, 3000);
        delay(100);
        noTone(9);
        delay(4000);
        //Wait
        petfeeder.write(45);
    }

    static void checkMillis(unsigned long &previousMillis, int &hours, int &minutes, int &elapsedMinutes) {
      const unsigned long interval = 5000; // Time interval in milliseconds (5 seconds)
      unsigned long currentMillis = millis(); // Get the current time  
      if(timeHasBeenObtained){ //Check if we have obtained time first
        if(hours >= 24){
          hours = 0;
          // minutes = 0;
          // elapsedHours += 1;
        }
        if(minutes >= 60){
          hours += 1;
          minutes = 0;
          elapsedMinutes += 60;
        }else{
          minutes = round(((millis() / 1000) / 1) + initialMinutes) - elapsedMinutes;
          // hours -= elapsedHours;
        }  

        unsigned long currentMillis = millis(); // Get the current time
        if (currentMillis - previousMillis >= 1000) {
          // Time has passed, perform action
          Serial.print(round(hours));
          Serial.print(":");
          Serial.print(minutes);
          Serial.println("");
          feeder.displayTime(round(hours),minutes,alarm,feeds);
          // Update the previous time
          previousMillis = currentMillis;
        }
      }
    }

    static void ProcessDate(String input, int &initialMinutes, int &initialHours, int &hours, bool &timeHasBeenObtained) {
      date += input;
      if (date.length() == 5){
        Serial.write(date.c_str()); //Convert back to char to serial write
        String lastTwoChars = date.substring(date.length() - 2);
        String firstTwoChars = date.substring(0, 2);

        //Get the hours and minutes
        initialMinutes = lastTwoChars.toInt();
        initialHours = firstTwoChars.toInt();
        hours = initialHours;
        timeHasBeenObtained = true;
      }
    }

    static void AddAlarm(String time, String &alarm, bool &feedingTimeAdded) {
      if (!feedingTimeAdded){ //Check if a feeding time has been added
        alarm += time;
        if(alarm.length() == 2){
          alarm = alarm.substring(0, 2);
          Serial.println(alarm);
          feeder.displayAlarmSet();
          delay(500);
          feedingTimeAdded = true;
        }
      }
    }

    static void checkFeedingTime(String alarm, int minutes) {
      if(feedingTimeAdded){
        if(alarm.toInt() == minutes){
          Serial.println("Time to feed");
          Time::releaseFood();
        }
      }
    }
};

void setup(){
  feeder.initialTone();
  feeder.splashScreen();

  pinMode(buzzer, OUTPUT);
  timeSinceStart = millis();

  //Initialize Serial Monitor
  Serial.begin(9600);
  Serial.println("ENTER AT Commands:");

  //Initialize Bluetooth Serial Port
  hc06.begin(9600);
  Serial.begin(9600);
  timeSinceStart = millis();
  petfeeder.attach(servoPin); 
  petfeeder.write(45); 
}

void loop(){
  delay(20); // Prevent program running too fast
  timeSinceStart = millis();
  readBluetooth();
  Time::checkFeedingTime(alarm,minutes);
}

void readBluetooth(){
  if(hc06.available()){ //Check if HC06 has sent a signal
    char receivedChar = hc06.read(); // Read a character from HC-06
    String dataString = String(receivedChar); // Convert character to a string
    if(timeHasBeenObtained == false){
      Time::ProcessDate(dataString, initialMinutes, initialHours, hours, timeHasBeenObtained); //Send the string to process date
    }else{
      Time::AddAlarm(dataString,alarm,feedingTimeAdded); //Send the string to addalarm
    }
  }

  if(timeHasBeenObtained){
    Time::checkMillis(previousMillis,hours,minutes,elapsedMinutes);
  }else{
    elapsedMinutes = (millis()/1000) / 60;
  }
}



