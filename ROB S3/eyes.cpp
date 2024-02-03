#include <Arduino.h>
#include "eyes.h"

// Eyes::Eyes(uint16_t pin1){
//   _pin1 = pin1;
//   pinMode(pin1, OUTPUT);
// }

void Eyes::flashOn(){
  pinMode(_pin1, OUTPUT);
  digitalWrite(_pin1, HIGH);
}

void Eyes::flashOff(){
  pinMode(_pin1, OUTPUT);
  digitalWrite(_pin1, LOW);
}