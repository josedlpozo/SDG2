/*=========================================================================
      Libreria para el uso del dispositivo MCP9800 - Sensor temperatura.
      Conexion con ARDUINO mediante bus I2C.
      
      Diseño por José María del Pozo Alonso, Fernando Pérez Fernández
      y Santiago Pérez Peña.

=========================================================================*/

/*=========================================================================

  Inclusion de libraries necesarias.

=========================================================================*/
#ifndef MCP9800_H_
#define MCP9800_H_
#include <Arduino.h>
#include <Wire.h>
#include <Sensor.h>

/*=========================================================================

  Direccion I2C del dispositivo

=========================================================================*/
#define MCP9800_ADDRESS		0x48

/*=========================================================================

  Definicion de registros.

=========================================================================*/
#define REG_TEMP			0x00	// Temperatur register
#define REG_CONFIG			0x01	// Configuration register
#define REG_HYSTERISIS		0x02	// Temperature Hysteresis register
#define REG_LIMIT			0x03	// Temperature Limit-set register
#define CONFIG_ONE_SHOT		0x07	// One shot enabled/disabled. Disabled by default
#define CONFIG_ADC_RES		0x05	// ADC resolution: 00 = 9bit (0.5c), 01 = 10bit (0.25c), 10 = 11bit (0.125c), 11 = 12bit (0.0625c)
#define CONFIG_FAULT_QUEUE	0x03	// Fault queue bits, 00 = 1 (default), 01 = 2, 10 = 4, 11 = 6
#define CONFIG_ALERT_POL	0x04	// Alert polarity (high/low). Default low
#define CONFIG_COMP_INT		0x03	// 1 = Interrupt mode, 0 = Comparator mode (default)
#define CONFIG_SHUTDOWN		0x02	// 1 = Enable shutdown, 0 = Disable shutdown (default)

/*=========================================================================

	Enumerado con la resolucion a elegir.

=========================================================================*/
typedef enum {
	MCP_ADC_RES_9 = 0,		/*!< 9bit  (0.5c) */
	MCP_ADC_RES_10,			/*!< 10bit (0.25c) */
	MCP_ADC_RES_11,			/*!< 11bit (0.125c) */
	MCP_ADC_RES_12			/*!< 12bit (0.0625c) */
} mcp9800_adc_resolution_t;

class MCP9800 : public Sensor
{

	public:
        MCP9800(int32_t sensorID = -1);
		void getEvent(sensors_t *mcp);
		bool init();
		int16_t readRawData();
		int16_t readCelsius();
		float readCelsiusf();
    void setResolution(mcp9800_adc_resolution_t resolution);

	private:
        int32_t         _sensorID;
		void write(uint8_t reg, uint8_t *data, int8_t len);
		void read(uint8_t reg, uint8_t *buffer, int8_t numBytes);
		uint8_t adc;
};


#endif 