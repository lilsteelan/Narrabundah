#ifndef eyes_h
#define eyes_h
#include <Arduino.h>

class Eyes{
  public:
    // Eyes(uint16_t pin1, uint16_t pin2); //constructor
    void flashOn();
    void flashOff();
  private:
    uint16_t _pin1 = 3;
};

#endif