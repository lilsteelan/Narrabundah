#define BUTTON_PIN 4
#define NUM_LEDS 80
#include <Wire.h> 
#include <LiquidCrystal_I2C.h>
#include <Servo.h>
#include <FastLED.h>

//All Written by Stellan Lindrud
//Note that the library LiquidCrystal I2C and FastLED are community made
//and do not come pre-installed
LiquidCrystal_I2C lcd(0x27,16,2);  // set the LCD address to 0x27(the I2C module address) for a 16 chars and 2 line display
CRGBArray<NUM_LEDS> leds;

float calibration = 0.073; 
float tempC;

int buzzPin = 7;
int ledPin = 13;
int state = 0;
int flag = 0;
bool primed = false;
int trigPin = 9;
int echoPin = 10;
int safetyDistance = 25;

long duration;
int distance;

Servo servo1;
Servo servo2;

int servoPin1 = 7;
int servoPin2 = 8;
int currentTime = millis();

void setup()
{
  initialise();
  splashScreen(); 
  initialTone();
}


//Here we initialise all the variables
// as well as pins and piece attachments
void initialise(){
  analogReference(INTERNAL);
  pinMode(ledPin, OUTPUT);
  digitalWrite(ledPin, LOW);
  Serial.begin(9600);
  pinMode(6,OUTPUT);
  pinMode(buzzPin, OUTPUT);
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);
  servo1.attach(3);
  servo2.attach(2);
  //allow time to put in springboard
  servo1.write(180);
  servo2.write(0);
  delay(2000);
  servo1.write(20);
  servo2.write(240);
  delay(1000);
  servo1.detach();
  servo2.detach();
  pinMode(BUTTON_PIN, INPUT_PULLUP);
  lcd.init();// initialize the lcd 
  FastLED.addLeds<NEOPIXEL,11>(leds, NUM_LEDS);
}

void initialTone(){
  tone(6,370);
  delay(50);
  noTone(6);
  delay(50);
  tone(6,370);
  delay(50);
  noTone(6);
  delay(50);
  tone(6,370);
  delay(50);
  noTone(6);
  delay(500);

  tone(6,370);
  delay(500);
  noTone(6);
  delay(100);
  tone(6,370);
  delay(500);
  noTone(6);
  delay(100);
  tone(6,370);
  delay(500);
  noTone(6);
  delay(100);
}

void splashScreen(){
  //lcd.init();
  // Print a message to the LCD.
  lcd.backlight();
  lcd.setCursor(0,0);
  lcd.print("Lindrud");
  lcd.setCursor(0,1);
  lcd.print("Productions!");
  delay(2000);
  lcd.clear();
  lcd.print("NOT PRIMED");
}

void readButton(){
  if(!digitalRead(BUTTON_PIN)){
    if(primed){ //check if we are primed
      startCountdown();
    }else{ // not primed send a beep to signify we wont launch
      tone(6,600,500);
    }
  }else{

  }
}

void readSerial(){
  //The flag is used to prevent the arduino from constantly checking if it's primed or not from the bluetooth device
  if(Serial.available() > 0){ //Check if data is being sent
    state = Serial.read();
    flag = 0;
  }

  if (state == '0'){
    digitalWrite(ledPin, LOW);
    if(flag==0){
      Serial.println("LED: off");
      displayNoPrime();
      primed = false;
      flag = 1;
    }
  }
  else if(state == '1'){
    if(primed){
      digitalWrite(ledPin, HIGH);
    }
    
    if(flag==0){
      Serial.println("LED: on");
      primed = true;
      displayPrime();
      flag = 1;
    }
  }
  else if(state == 'A'){ //Launch Code
    startCountdown();
    state = 0;
  }

}

void primeBeep(){
  tone(6,370,1000); //indicate connection
  delay(1000);
}

void noprimeBeep(){
  tone(6,259,1000); //Indicate that we have deprimed
  delay(1000);
}

void displayPrime(){
  primeBeep();
  lcd.clear();
  lcd.print("PRIMED!");
}

void launch(){
  //Here we re-attach the servos, move them and then detach them
  servo1.attach(3);
  servo2.attach(2);
  servo1.write(180);
  servo2.write(0);
  delay(2000);
  servo1.detach();
  servo2.detach();
}

void displayNoPrime(){
  noprimeBeep();
  lcd.clear();
  lcd.print("NOT PRIMED");
  servo1.write(180);
  servo2.write(180);
}

void startCountdown(){
  int count = 10;
  lcd.setCursor(0,1);
  int x;
  bool odd;
  int r,g,b;
  for(x=count;x--;x>0){ //10 seconds countdown backwards
    lcd.clear();
    lcd.print(x);
    tone(6,600,300);
    delay(1000);
    //Assign a random color for each second
    r = random(0,255);
    g = random(0,255);
    b = random(0,255);
    for(int i = 0; i < NUM_LEDS; i++){
      leds[i] = CHSV(r,g,b);
    }
    FastLED.show();
    //FastLED.delay(33);
  }

  lcd.clear();
  launch();
  lcd.print("LAUNCH!");
}

void getTemperature(){
  tempC = (analogRead(A3) * calibration) - 50.0;
  //Serial.print("Temperature:  ");
  //Serial.print(tempC, 1);
  //Serial.println(" C");

  //Serial.println(millis() - currentTime);
  if(millis() - currentTime > 1000){
    //Serial.write(distance);
    currentTime = millis();
    lcd.setCursor(0,1);
    lcd.print(" ");
    lcd.print(tempC);
    lcd.print("C");
  }
  // delay(500);
  
}

void displayDistance(){ //Check if anything is in immediate range of the device
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);

  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);

  duration = pulseIn(echoPin, HIGH);
  distance = duration * 0.034/2;
  //Serial.print("Distance: ");
  //Serial.println(distance); 

  if(distance < safetyDistance){ //too close dont start
    primed = false;
    //Serial.println("LED: off");
    displayNoPrime();
    digitalWrite(ledPin, LOW);
    primed = false;
    flag = 1;
  }

}

void primeLED(){
  static uint8_t hue;
  servoPin1 = 7;
  for(int i = 0; i < NUM_LEDS/2; i++) {   
    // fade everything out
    leds.fadeToBlackBy(40);

    // let's set an led value
    leds[i] = CHSV(hue++,255,255);

    // now, let's first 20 leds to the top 20 leds, 
    leds(NUM_LEDS/2,NUM_LEDS-1) = leds(NUM_LEDS/2 - 1 ,0);
    FastLED.delay(33);
    //delay(33);
  }
}

void base(){
  
  for(int i = 0; i < NUM_LEDS; i++){
    leds[i] = CHSV(210+(i*2),255,255);
  }

  FastLED.show();
  FastLED.delay(33);
}

void loop()
{
  //Everything done here is in order and sorted into functions
  //so that you can easily see and edit whats going on
  readSerial();
  getTemperature();
  displayDistance();
  readButton();
  if(primed){
    primeLED();
  }else{
    base();
  }
}
