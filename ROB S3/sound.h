#ifndef sound_h
#define sound_h
#include <Arduino.h>

class Sound{
  public:
    Sound(int pin); //constructor
    void wakeUp();
    void happy();
    void tooClose();
    void debug();
  private:
    int _pin;   
};

#endif