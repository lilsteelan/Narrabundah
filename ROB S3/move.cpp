#include <Arduino.h>
#include <Servo.h>
#include "move.h"

Move::Move(int i) { //constructor to initiliase servos
  servos = (Servo **)malloc(4 * sizeof(Servo *));

  for (int i = 0; i < 4; i++) {
    servos[i] = new Servo();
  }

  // Connect all servos, a for loop was not used since the servos are not attached in order
  servos[0]->attach(9); 
  servos[1]->attach(12);
  servos[2]->attach(11);
  servos[3]->attach(10);
}

void Move::setMiddle(){
  for (int i = 0; i < 4; i++) {
    servos[i]->write(middle);
  }

}

void Move::writeServo(int servoIndex, int position){
  servos[servoIndex]->write(position);
  Serial.println("moving");
}

