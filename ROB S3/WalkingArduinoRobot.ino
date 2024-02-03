/*
All code written by Stellan Lindrud | Narrabundah College 

When using millis, all if statements check for a difference in time
since that last action and compares this to some set value, and if this difference
is larger than this set value it implies that enough time has passed to perform
this action again. Refer to millis usage below

Furthermore all millis based checks were done in the main ino file as the vast amount
of different variables using millis need to remain global for the program to work
*/  

#include <Servo.h>
#include <Wire.h>
#include "sound.h"
#include "head.h"
#include "eyes.h"
#include "move.h"

//Servo definitions for legs
Servo servo1;
Servo servo2;
Servo servo3;
Servo servo4;

// Use of dynamic memory is only reccomended for arrays
// Servo **servos;
uint8_t servoIndex = 0;
bool isWaiting = false;
bool moving = false;
long lastLegMove;


//Servo head
// Servo servo5;

Sound sound(4); //setup sound on pin 4
Eyes eyes; //setup eyes 
Head head(13);
Move move(0);

//Base variables used for body and head movement
const uint8_t middle = 90;
const uint8_t endPoint = 85;
const uint16_t stepDelay = 350;
uint16_t stepsMade = 0;
bool inMiddle = false;
const uint16_t headWaitTime = 2000;
const uint16_t flashDelay = 1000;
bool flag = true;
uint16_t timeSinceLastFlash = 0;
uint16_t timeSinceLastHeadMove = 0;
bool headLeft = false;

long timeSinceLastBuzz;
long timeSinceLastMove = 0;
long int currMillis;

// define pins for ultrasonic
const uint8_t trigPin = 5;
const uint8_t echoPin = 6;
long duration;
int distance;

void setup()
{
  Serial.begin(9600);  // Initialize serial communication at 9600 baud
  
  pinMode(trigPin, OUTPUT); // Sets the trigPin as an Output
  pinMode(echoPin, INPUT); // Sets the echoPin as an Input

  sound.wakeUp();
  // eyes.flashOn();
}

void loop() {
  measureDistance();
  step();   
  moveHead();
  flashEyes();
}

void measureDistance(){
  // Clears the trigPin
  digitalWrite(trigPin, LOW);

  delayMicroseconds(2);
  // Sets the trigPin on HIGH state for 10 micro seconds
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  // Reads the echoPin, returns the sound wave travel time in microseconds
  duration = pulseIn(echoPin, HIGH);
  // Calculating the distance
  distance = duration * 0.034 / 2;
  if(distance < 10){
    sound.tooClose();
    eyes.flashOn();
  }else{
    eyes.flashOff();
  }
  // Serial.println(distance);
}

void moveHead(){
  //check if headWaitTime (2s) has passed
  if(millis() - timeSinceLastHeadMove > headWaitTime){
    if(headLeft == true){
      Serial.println("right");
      head.turnRight();
      headLeft = false;  //change the direction of head
    }else{
      head.turnLeft();
      Serial.println("left");
      headLeft = true;  //change the direction of head
      
    }
    timeSinceLastHeadMove = millis(); //reset difference in time 
  }
}

void step(){
    //Check if servos need to be placed back into their initial positions
    if(!inMiddle && millis() - timeSinceLastMove > stepDelay){
      move.setMiddle();
      inMiddle = true;
    }
  

    if(millis() - timeSinceLastMove > stepDelay && moving==false){ // check if enough time has passed before doing another action
      moving = true;
      // servos[servoIndex].write(middle - endPoint); //move first servo
      servoIndex = 0;
      lastLegMove = millis(); //set the last leg movement
    }

    if (moving==true && millis() - lastLegMove > stepDelay){
      if(servoIndex < 2){
        // servos[servoIndex]->write(middle - endPoint);
        move.writeServo(servoIndex, middle  - endPoint);
        // delay(300);
      }else{
        // servos[servoIndex]->write(middle + endPoint);
        move.writeServo(servoIndex, middle + endPoint);
      }
      servoIndex++;
      lastLegMove = millis();

      // Reset index back to first leg
      if(servoIndex == 4){
        servoIndex = 0;
        moving = false;
        stepsMade += 1;
        timeSinceLastMove = millis(); // Reset difference in time
        inMiddle = false; // Tell program to move legs back to middle
      }
    }
}

//Not used in this program
void flashEyes(){
  if(millis() - timeSinceLastFlash > flashDelay){
    timeSinceLastFlash = millis();
    if(flag==true){
      flag = false;
      eyes.flashOff();
    }else{
      flag = true;
      eyes.flashOn();
    }
  }
}
