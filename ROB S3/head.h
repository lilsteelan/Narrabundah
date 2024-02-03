#ifndef head_h
#define head_h
#include <Arduino.h>
#include <Servo.h>

class Head{
  public:
    Head(int pin); //constructor
    void observe();
    void turnRight();
    void turnLeft();
    Servo servo5;
  private:
    int pin_;
};

#endif
