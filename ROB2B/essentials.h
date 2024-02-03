// Header Guards
#ifndef ESSENTIALS_H
#define ESSENTIALS_H

#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Arduino.h>
// #include "essentials.h"

class FeederController {
  private:
      LiquidCrystal_I2C lcd;

  public:
      FeederController();

      void splashScreen();

      void initialTone();

      void timeSetTone();

      int displayTime(int hours, int minutes, String alarm, int feeds);

      void feedLCD();

      void displayAlarmSet();
};

extern FeederController feeder;

#endif
