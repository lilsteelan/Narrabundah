#ifndef move_h
#define move_h
#include <Arduino.h>
#include <Servo.h>

class Move{
  public:
    Move(int i); //constructor
    void step();
    void setMiddle();
    void writeServo(int servoIndex, int position);
  private:
    Servo **servos;
    uint8_t middle = 90;
    //Not much to see here...
};

#endif
