/*=========================================================================
      Libreria para el uso del dispositivo MCP9800 - Sensor temperatura.
      Conexion con ARDUINO mediante bus I2C.
      
      Diseño por José María del Pozo Alonso, Fernando Pérez Fernández
      y Santiago Pérez Peña.

=========================================================================*/

/*=========================================================================

  Inclusion de libraries necesarias.

=========================================================================*/
#include <limits.h>
#include "MCP9800.h"
#include <Serial.h>

/*=========================================================================

	Inicia el dispositivo. Configura para realizar medidas.

=========================================================================*/
bool MCP9800::init()
{
	//Wire.begin();
	uint8_t config;
	read(REG_CONFIG, &config, 1);
	bool ok = (config == 0); // all values are 0 on power up
	return ok;
}

/*=========================================================================

	Escribe en el registro espeficado los datos especificados.

=========================================================================*/
void MCP9800::write(uint8_t reg, uint8_t *data, int8_t len)
{
	Wire.beginTransmission(MCP9800_ADDRESS);
	Wire.write(reg);

	while (len--)
	{
		Wire.write(*data++);
	}

	Wire.endTransmission();
}

/*=========================================================================

	Lee del registro especificado el numero de bytes especificado.

=========================================================================*/
void MCP9800::read(uint8_t reg, uint8_t *buffer, int8_t numBytes)
{
	Wire.beginTransmission(MCP9800_ADDRESS);
	Wire.write(reg);
	Serial.print(Wire.endTransmission());
	Wire.requestFrom((uint8_t)MCP9800_ADDRESS, (uint8_t)numBytes);
	while (Wire.available() < numBytes) {}; // wait for data to come back
	while (numBytes--)
	{
		*buffer++ = Wire.read();
	}
}

/*=========================================================================

	Establece la resolucion.

=========================================================================*/
void MCP9800::setResolution(mcp9800_adc_resolution_t resolution)
{
	uint8_t config = 0;
	read(REG_CONFIG, &config, 1);
	config &= ~(3 << CONFIG_ADC_RES);
	config |= (resolution << CONFIG_ADC_RES);
	write(REG_CONFIG, &config, 1);
	adc = resolution;
}

/*=========================================================================
 
 Constructor de la clase. Recibe como parametro un identificador.
 
 =========================================================================*/
MCP9800::MCP9800(int32_t sensorID) {
    _sensorID = sensorID;
}

/*=========================================================================

  Lee datos del sensor.

=========================================================================*/
int16_t MCP9800::readRawData()
{
	uint8_t temp[2] = {0,0};
	read(REG_TEMP, temp, 2);
	return (temp[0] << 8) | temp[1];
}

/*=========================================================================

	Lee temperatura en grados celsius.

=========================================================================*/
int16_t MCP9800::readCelsius()
{
	int16_t temp = readRawData();
	int8_t highByte = (temp >> 8);
	uint8_t lowByte = (temp & 0xFF);
	temp = (highByte << 4) | (lowByte >> 4);

	return temp;
}

/*=========================================================================

	Convierte la medida a grados con float.

=========================================================================*/
float MCP9800::readCelsiusf()
{
	int16_t temp = readCelsius();
	return temp / 16.0f;
}

#define DATA_TO_CELSIUS 0.1125 // 16 / 9 / 5

/*=========================================================================

  Devuelve el evento mas actual. Almacena el valor de 
  temperatura en sensors_t.

=========================================================================*/
void MCP9800::getEvent(sensors_t *mcp) {
  /* Borra datos anteriores */
  memset(mcp, 0, sizeof(sensors_t));
  
  mcp->mcp98.tempC = readCelsiusf();
  
}