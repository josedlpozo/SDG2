#include <VirtualWire.h>
#include <LiquidCrystal.h>
LiquidCrystal lcd (12,11,5,4,3,2);
const int led_pin = 6;
const int transmit_pin = 12;
const int receive_pin = 8;
//const int transmit_en_pin = 3;

String sensores[] = { "Acel Eje X", "Acel Eje Y", "Acel Eje Z", "Temperatura", "Humd. tierra", "Rocio", "Luminosidad","Brujula","Humedad"};

void setup()
{
    delay(1000);
    Serial.begin(9600);	// Debugging only
    Serial.println("setup");
    lcd.begin(16,2);
    lcd.setCursor(0,1);
    lcd.print("RECEPTOR");
    // Initialise the IO and ISR
    vw_set_tx_pin(transmit_pin);
    vw_set_rx_pin(receive_pin);
    //vw_set_ptt_pin(transmit_en_pin);
    vw_set_ptt_inverted(true); // Required for DR3100
    vw_setup(2000);	 // Bits per sec

    vw_rx_start();       // Start the receiver PLL running
}

void loop()
{
    uint8_t buf[VW_MAX_MESSAGE_LEN];
    uint8_t buflen = VW_MAX_MESSAGE_LEN;
    Serial.println("NO FUNCIONA");
    if (vw_get_message(buf, &buflen)) // Non-blocking
    {
      Serial.println("recibo");
	int i;
        int j;
        int h;
	lcd.clear();
        
        
        for ( i = 0; i < buflen; i++ )
        {
          if(i==0 && buf[i] =='#'){
            Serial.println("INICIO DE CADENA");
            h=0;
            j=1;}
          if(buf[i] == '+'){
            lcd.clear();
            lcd.print(sensores[h]);
            lcd.setCursor(0,2);
            j++;
            for(j;j<i;j++){
              lcd.write(buf[j]); 
            }
          }else if(buf[i] == '*'){
            lcd.clear();
            lcd.print(sensores[h]);
            lcd.setCursor(0,2);
            j++;
            for(j;j<i;j++){
              lcd.write(buf[j]); 
            }
            switch (h){
                case 0:
                case 1:
                case 2:
                    lcd.write(" m/s^2");
                    break;
                case 3:
                    lcd.write(" C");
                    break;
                case 4:
                case 5:
                case 6:
                    lcd.write(" %");
                    break;
                case 7:
                    lcd.write(" grados");
                    break;
                case 8:
                    lcd.write(" %");
                    break;
                default:
                    lcd.write("FALLO");
              }
            h++;
            delay(2000);
          }
        }
    }
}
