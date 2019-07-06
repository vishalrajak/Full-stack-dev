#include "DHT.h"        // including the library of DHT11 temperature and humidity sensor

#include <ESP8266WiFi.h>  
#include <WiFiClient.h>  
#include <ThingSpeak.h>  

#define DHTTYPE DHT11   // DHT 11

#define dht_dpin 2

const char* ssid = "Ninad";  
const char* password = "9004248602";  
WiFiClient client;  
unsigned long myChannelNumber = 457071;  
const char * myWriteAPIKey = "PE5JXTT7JZJEQRYA";  
uint8_t temperature, humidity;  

int ledPin = 13;

DHT dht(dht_dpin, DHTTYPE); 
void setup(void)
{ 
  dht.begin();
  Serial.begin(9600);
  //Serial.println("Humidity and temperature\n\n");
  delay(10);  
  // Connect to WiFi network  
   pinMode(ledPin, OUTPUT);
  digitalWrite(ledPin, LOW);
  
  Serial.println();  
  Serial.println();  
  Serial.print("Connecting to ");  
  Serial.println(ssid);  
  WiFi.begin(ssid, password);  
  while (WiFi.status() != WL_CONNECTED)  
  {  
   delay(500);  
   Serial.print(".");  
  }  
  Serial.println("");  
  Serial.println("WiFi connected");  
  // Print the IP address  
  Serial.println(WiFi.localIP());  
  ThingSpeak.begin(client);  
}  
int f=1;

void loop() {
  static boolean data_state = false;
  boolean motor=false;


  
    float humidity = dht.readHumidity();
   float temperature = dht.readTemperature(); 
    
    int SensorValue =analogRead(A0);             
  Serial.println("Temperature Value is :");  
  Serial.print(temperature);  
  Serial.println("C ");  
  
  Serial.println("Humidity Value is :");  
  Serial.print(humidity);  
  Serial.println("%");


    Serial.println("Soil moisture :");
    Serial.print(SensorValue);
    Serial.println();

   
  // Write to ThingSpeak. There are up to 8 fields in a channel, allowing you to store up to 8 different  
  // pieces of information in a channel. Here, we write to field 1.  
   
  /* ThingSpeak.writeField(myChannelNumber, 3, SensorValue, myWriteAPIKey);
   delay(15000);
   ThingSpeak.writeField(myChannelNumber, 2, humidity, myWriteAPIKey);
   delay(15000);
   ThingSpeak.writeField(myChannelNumber, 4, temperature, myWriteAPIKey);
   delay(15000);
   */
   
   /* if( data_state )  
  {  
   ThingSpeak.writeField(myChannelNumber, 4, temperature, myWriteAPIKey);  
   data_state = false;  
  }  
  else  
  {  
   ThingSpeak.writeField(myChannelNumber, 2, humidity, myWriteAPIKey);  
   data_state = true;  
  }  
  delay(15000);*/

if(SensorValue>400 || humidity >70 || temperature > 35)
{
  digitalWrite(ledPin, HIGH);
  motor=true;
}
else
{
  digitalWrite(ledPin, LOW);
  motor=false;
}



if(f==1)
{
  ThingSpeak.writeField(myChannelNumber, 2, humidity, myWriteAPIKey);
  f=2;
}
else
{
  ThingSpeak.writeField(myChannelNumber, 4, temperature, myWriteAPIKey);
   f=1; 
  
}



/*
if(f==1)
{
   ThingSpeak.writeField(myChannelNumber, 3, SensorValue, myWriteAPIKey);
   f=2;
}
else if(f==2)
{
  ThingSpeak.writeField(myChannelNumber, 2, humidity, myWriteAPIKey);
   f=3;
}
else
{
   ThingSpeak.writeField(myChannelNumber, 4, temperature, myWriteAPIKey);
   f=1; 
} */

delay(15000);



  ThingSpeak.writeField(myChannelNumber, 5, motor, myWriteAPIKey);
  
delay(15000);








}
