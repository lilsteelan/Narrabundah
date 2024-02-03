#include <Arduino.h>
#include <Servo.h>
#include "head.h"

Servo servo5; //5th servo on device

Head::Head(int pin){
  // servo5.attach(pin);
}

//Weird issue where servo spazzes just because its attached
//its not called, the servo library is very weird
void Head::turnLeft(){
  servo5.attach(13);
  servo5.write(0);
  Serial.println("turning left");
  // servo5.detach();
}

void Head::turnRight(){
  servo5.attach(13);
  servo5.write(90);
  Serial.println("turning right");
  // servo5.detach();
}
