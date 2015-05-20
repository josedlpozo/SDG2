#include <Wire.h>
#include <VirtualWire.h>
#include <ADXL345.h>
#include <DHT.h>
#include <Sensor.h>
#include <PCF8591.h>
#include <HMC5883.h>


#define DHTPIN 2
DHT dht = DHT(DHTPIN);



ADXL345 acel = ADXL345(12345);
HMC5883 bruj = HMC5883(12345);
PCF8591 pcf = PCF8591(12345);

float acelx, acely, acelz;
float pcft, pcfh, pcfr, pcfl;
float brujx, brujy, brujz, grados;
float dht22h, dht22t, dht22f;

char msg[10];
char t[10];

const int led_pin = 11;
const int transmit_pin = 4;
const int receive_pin = 2;
const int transmit_en_pin = 3;
int chipSelect = 10;

void setup(){
  Wire.begin();
  Serial.begin(19200);
  vw_set_tx_pin(transmit_pin);
  vw_set_ptt_pin(transmit_en_pin);
  vw_set_ptt_inverted(true); // Required for DR3100
  vw_setup(2000);	 // Bits per sec
  
  
  if(!acel.begin())
      {
        /* No detecta acelerometro */
        Serial.println("No hay acelerometro detectado!");
        while(1);
      }
   acel.setRange(ADXL345_RANGE_16_G);
   if(!bruj.begin())
      {
        /* No detecta acelerometro */
        Serial.println("No hay acelerometro detectado!");
        while(1);
      }
     // Initialise the IO and ISR

  dht.begin();
  
}

void loop(){
  
    sensors_t event;
    acel.getEvent(&event);
    acelx = event.acceleration.x;
    acely = event.acceleration.y;
    acelz = event.acceleration.z;
    delay(500);
    pcf.getEvent(&event);
    pcft = event.pcf.t;
    pcfh = event.pcf.h;
    pcfr = event.pcf.r;
    pcfl = event.pcf.l;

    pcft = ((pcft*(5.0 / 255)) - 1.375) / 0.0225;
    pcfh = 100 - (pcfh/255)*100;
    pcfr = 100 - (pcfr/255)*100;
    pcfl = (pcfl/255)*100;
            Serial.print("T: ");Serial.println(pcft);
    Serial.print("H: ");Serial.println(pcfh);
    Serial.print("R: ");Serial.println(pcfr);
    Serial.print("L: ");Serial.println(pcfl);
    delay(500);
    bruj.getEvent(&event);
    brujx = event.brujula.x;
    brujy = event.brujula.y;
    brujz = event.brujula.z;
    float heading = atan2(event.brujula.y, event.brujula.x);
    if(heading < 0)
      heading += 2*PI;
    if(heading > 2*PI)
      heading -= 2*PI;
    float headingDegrees = heading * 180/PI; 
    grados = headingDegrees;
    delay(500);
    dht.getEvent(&event);
    dht22h = event.dht22.humidity;
    dht22t = event.dht22.tempC;
    dht22f = event.dht22.heatIndex;
    
    float tm = (pcft + dht22t)/2;
    
    char envio [50] = "";
    dtostrf(acelx, 6, 2, t);
    strcat(envio,"#");
    strcat(envio,t);
    strcat(envio,"+");
    dtostrf(acely, 6, 2, t);
    strcat(envio,t);
    strcat(envio,"+");
    dtostrf(acelz, 6, 2, t);
    strcat(envio,t);
    strcat(envio,"+");
    dtostrf(tm, 6, 2, t);
    strcat(envio,t);
    strcat(envio,"+");
    dtostrf(pcfh, 6, 2, t);
    strcat(envio,t);
    strcat(envio,"+");
    dtostrf(pcfr, 6, 2, t);
    strcat(envio,t);
    strcat(envio,"+");
    dtostrf(pcfl, 6, 2, t);
    strcat(envio,t);
    strcat(envio,"+");
    dtostrf(grados, 6, 2, t);
    strcat(envio,t);
    strcat(envio,"+");
    dtostrf(dht22h, 6, 2, t);
    strcat(envio,t);
    strcat(envio,"*");
    Serial.println(envio);
    vw_send((uint8_t *)envio, strlen(envio));
    vw_wait_tx(); // Wait until the whole message is gone
    delay(1000);
}


