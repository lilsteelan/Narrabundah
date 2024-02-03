#include <Arduino.h>
#include "sound.h"

Sound::Sound(int pin){
  _pin = pin;
  pinMode(pin, OUTPUT);
}

void Sound::happy(){
  tone(_pin, 1000, 1000);
  tone(_pin, 2400, 1000);
  tone(_pin, 1000, 1000);
}

void Sound::wakeUp(){
  tone(_pin, 2000, 1000);
  tone(_pin, 500, 100);
  tone(_pin, 1500, 400);

}

void Sound::tooClose(){
  tone(_pin, 2000, 100);
  tone(_pin, 1000, 10);
  tone(_pin, 2000, 100);
}

void Sound::debug(){
  tone(_pin, 1500, 300);
}