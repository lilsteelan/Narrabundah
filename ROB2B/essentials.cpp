#include "essentials.h"
// #include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <Arduino.h>

FeederController feeder;

FeederController::FeederController() : lcd(0x27, 20, 4) {
    // Constructor implementation
}

void FeederController::splashScreen() {
    lcd.init();
    lcd.backlight();
    lcd.setCursor(0, 0);
    lcd.print("Lindrud");
    lcd.setCursor(0, 1);
    lcd.print("Productions!");
    delay(2000);
    lcd.clear();
    lcd.backlight();
    lcd.setCursor(0, 0);
    lcd.print("FeederX");
    lcd.setCursor(0, 1);
    lcd.print("SET TIME");
}

void FeederController::initialTone() {
    // for(int x=0;x<3;x++){
    // tone(9,370);
    // delay(1000);
    // noTone(9);
    // }
  delay(500);
  for(int x=0;x<3;x++){
    delay(50);
    tone(9,370);
    delay(50);
    noTone(9);
  }
  delay(500);

  // Set here is unique so it can't be simplified
  tone(9,370);
  delay(500); //Change in delay
  noTone(9);
  delay(100); //Change in delay
  tone(9,370);
  delay(500);
  noTone(9);
  delay(100);
  tone(9,370);
  delay(500);
  noTone(9);
  delay(100);
}

void FeederController::timeSetTone(){ //Beep to indicate that the time has been set
  tone(9,900);
  delay(500); //Change in delay
}

int FeederController::displayTime(int hours, int minutes,String alarm,int feeds) {
    lcd.clear();
    lcd.setCursor(0, 1);
    lcd.print(String(round(hours)) + ":" + minutes);
    lcd.setCursor(10,0);
    lcd.print("Alarm:");
    lcd.setCursor(10,1);
    lcd.print(alarm);
    lcd.setCursor(0,0);
    lcd.print("Feeds:" + String(feeds));
}

void FeederController::feedLCD() {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Time to Feed!");
}

void FeederController::displayAlarmSet() {
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Alarm Set!");
    tone(9,1000,800);
    // delay(800);
}

