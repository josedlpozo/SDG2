#include <Servo.h> 

#define MODO_SIGUELINEAS 1
#define MODO_BLUETOOTH 2

#define MODO_DELANTE 0
#define MODO_ATRAS 1
#define MODO_DELANTE_DERECHA 2
#define MODO_DELANTE_IZQUIERDA 3
#define MODO_ATRAS_DERECHA 4
#define MODO_ATRAS_IZQUIERDA 5
#define MODO_PARADO 6

#define DELANTE_DERECHA 0
#define ATRAS_DERECHA 180

#define DELANTE_IZQUIERDA 180
#define ATRAS_IZQUIERDA 0

#define PARADO 90


Servo izquierda;  // Cremos el objeto de servo
Servo derecha;

int modo = 0;

int modo_s_b = 1;

int rs,ls;

const int BLACK = 0;
const int WHITE = 1;

const int SL = 3;    // the number of the left sensor pin
const int SR= 5;     // the number of the right sensor pin

int ledRojo = 10; //Declara Pin LED Rojo
int ledVerde = 11; //Declara Pin LED Verde
int ledAzul = 12;  //Declara Pin LED Azul

int i = 0;

void setup(){
  Serial.begin(19200);
  izquierda.attach(7);  // attaches the servo on pin 9 to the servo object
  derecha.attach(9); 
  pinMode(ledRojo,OUTPUT);  //El LED Rojo como una salida
  pinMode(ledVerde,OUTPUT); //El LED Verde como una salida
  pinMode(ledAzul,OUTPUT);  //El LED Azul como una salida
  setRojo();
  pinMode(SL, INPUT);
  pinMode(SR, INPUT);
}

void loop(){
  if(modo_s_b == MODO_SIGUELINEAS){
    setDireccion();
  }else if(modo_s_b == MODO_BLUETOOTH){
    setModo();
  }
  
}

void setRojo(){
  analogWrite(ledRojo,255);
  analogWrite(ledVerde,0);
  analogWrite(ledAzul,0);
}

void setVerde(){
  analogWrite(ledRojo,0);
  analogWrite(ledVerde,255);
  analogWrite(ledAzul,0);
}

void setAzul(){
  analogWrite(ledRojo,0);
  analogWrite(ledVerde,0);
  analogWrite(ledAzul,255);
}

void setNegro(){
  analogWrite(ledRojo,0);
  analogWrite(ledVerde,0);
  analogWrite(ledAzul,0);
}

void setMorado(){
  analogWrite(ledRojo,204);
  analogWrite(ledVerde,0);
  analogWrite(ledAzul,204);
}



void setDireccion(){
  
  rs = digitalRead(SR);
  ls = digitalRead(SL);
  
  setAzul();
//-- Move the robot according to the inputs
  if (ls == BLACK && rs == BLACK){ 
     atras();
  }  

  else if (ls == WHITE && rs == BLACK){  
     delante_derecha();
     delay(10);
  }  

  else if (ls == BLACK && rs == WHITE){
    delante_izquierda();
    delay(10);
  }  
  
  else{ 
    parado();
     
  }

}
  

void setModo(){
    switch(modo){
      case MODO_DELANTE:
              delante();
              break;
      case MODO_ATRAS:
              atras();
              break;
      case MODO_DELANTE_DERECHA:
              delante_derecha();
              break;
      case MODO_DELANTE_IZQUIERDA:
              delante_izquierda();
              break;
      case MODO_ATRAS_DERECHA:
              atras_derecha();
              break;
      case MODO_ATRAS_IZQUIERDA:
              atras_izquierda();
              break;
      case MODO_PARADO:
              parado();
              break;
      default:
              Serial.println("NO DEFINIDO");
    }
}

void delante(){
  Serial.println("DELANTE");
  izquierda.write(DELANTE_IZQUIERDA);
  derecha.write(DELANTE_DERECHA);
}

void atras(){
    Serial.println("ATRAS");
  izquierda.write(ATRAS_IZQUIERDA);
  derecha.write(ATRAS_DERECHA);
}

void delante_derecha(){
    Serial.println("DELANTE DERECHA");
  izquierda.write(DELANTE_IZQUIERDA);
  derecha.write(ATRAS_DERECHA);
}

void delante_izquierda(){
    Serial.println("DELANTE IZQUIERDA");
  izquierda.write(ATRAS_IZQUIERDA);
  derecha.write(DELANTE_DERECHA);
}

void atras_izquierda(){
    Serial.println("ATRAS IZQUIERDA");
  izquierda.write(ATRAS_DERECHA);
  derecha.write(ATRAS_DERECHA);
}

void atras_derecha(){
      Serial.println("ATRAS DERECHA");
  izquierda.write(ATRAS_IZQUIERDA);
  derecha.write(ATRAS_DERECHA);
}

void parado(){
      Serial.println("PARADO");
  izquierda.write(PARADO);
  derecha.write(PARADO);
}

void serialEvent(){
  if(Serial.available()){
      char letra = Serial.read();
      if(letra == 'S'){
        modo_s_b = MODO_SIGUELINEAS;
      }else if(letra == 'B'){
        modo_s_b = MODO_BLUETOOTH;
      }
      
      if(modo_s_b == MODO_BLUETOOTH){
        if(letra == '0'){
          modo = MODO_DELANTE;
          setRojo();
        }else if(letra == '1'){
          modo = MODO_ATRAS;
          setVerde();
        }else if(letra == '2'){
          modo = MODO_ATRAS_IZQUIERDA;
          setRojo();
        }else if(letra == '3'){
          modo = MODO_DELANTE_IZQUIERDA;
          setVerde();
        }else if(letra == '4'){
          modo = MODO_DELANTE_DERECHA;
          setVerde();
        }else if(letra == '5'){
          modo = MODO_ATRAS_DERECHA;
          setRojo();
        }else if(letra == '6'){
          modo = MODO_PARADO;
          setMorado();
        }
            setModo();
      }
  }
}
