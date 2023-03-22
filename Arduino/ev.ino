#include <ezBuzzer.h>
#include <ezButton.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClientSecure.h>
#include <WiFiClient.h>
#include <ESP8266WebServer.h>
#include <ESP8266mDNS.h>
#include <SPI.h>
#include <Servo.h>
const int BUZZER_PIN = 2;
ezButton limitSwitch(13);
ezButton limitSwitch2(0);
int LED =14;
const int RELAY_PIN = 4;
#define servoPin 5
Servo servoMotor;
//FiberHGW_ZTXA6S_2.4GHz
//123456789oa
const char* ssid = "FiberHGW_ZTXA6S_2.4GHz";
const char* password =  "123456789oa";
String url = "https://192.168.1.55/evotomasyonu/sayfalar/isikdurum.php";
String url2 = "https://192.168.1.55/evotomasyonu/sayfalar/vanadurum.php";
String url3 = "https://192.168.1.55/evotomasyonu/sayfalar/kapidurum.php";
const char* host = "192.168.1.55";
const char* host2 = "192.168.1.55";
void setup() {
  Serial.begin(115200);
  WiFi.begin(ssid, password);
   pinMode(LED, OUTPUT);  
   pinMode(RELAY_PIN, OUTPUT);
   pinMode(BUZZER_PIN, OUTPUT);
 
   servoMotor.attach(servoPin);
  Serial.println("");
  Serial.print("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  if (WiFi.status() == WL_CONNECTED) {
      WiFiClientSecure client;
      WiFiClient client2;
       WiFiClient client3;
       WiFiClient client4;
    client.setInsecure();
 
    HTTPClient https;
     HTTPClient https2;
       HTTPClient https3;
    Serial.println("\n Requesting " + url);
     Serial.println("\n Requesting " + url2);
      Serial.println("\n Requesting " + url3);
       //------------------LED--------------------
   if (https.begin(client, url)) {
      int httpCode = https.GET();
     
      String payload = https.getString();
    
      if (httpCode > 0) {
        
        Serial.println("Vana :"+payload);
         if (payload =="0"){
                 
                  digitalWrite(LED, HIGH);
         }
        else if(payload =="1"){
        
          digitalWrite(LED, LOW);
          }
             
      }
      https.end();
    } else {
      Serial.printf("Sayfaya Bağlantı Sağlanamadı.");
    }
//------------------LED--------------------
//------------------SERVO MOTOR--------------------

 if (https3.begin(client, url3)) {
    ezBuzzer buzzer(BUZZER_PIN);
       buzzer.loop();
      int httpCode3 = https3.GET();
      String payload3 = https3.getString();
       int state2 = limitSwitch2.getState();
        //--------------------ALARM---------------------------
       
      if(payload3=="0" && state2==1){
          
         analogWrite(BUZZER_PIN, 999);
         
      }
      else{
         analogWrite(BUZZER_PIN, 0);
        }
         
      //--------------------ALARM---------------------------
      if (httpCode3 > 0) {
        
        Serial.println("Servo :"+payload3);
         if (payload3 =="0"){
         
                   servoMotor.write(0); 
           

         }
        else if(payload3 =="1"){
          
       
          servoMotor.write(180);
        
          } 
      }
      https.end();
    } else {
      Serial.printf("Sayfaya Bağlantı Sağlanamadı.");
    }

   //------------------SERVO MOTOR--------------------   
   //------------------VANA--------------------

    if (https2.begin(client, url2)) {
      int httpCode2 = https2.GET();
     
      String payload2 = https2.getString();
    
      if (httpCode2 > 0) {
        
        Serial.println("Vana :"+payload2);
         if (payload2 =="0"){
                 
                  digitalWrite(RELAY_PIN, HIGH);
         }
        else if(payload2 =="1"){
        
          digitalWrite(RELAY_PIN, LOW);
          }
             
      }
      https.end();
    } else {
      Serial.printf("Sayfaya Bağlantı Sağlanamadı.");
    }
  //------------------VANA--------------------
  //--------------------PENCERE SWİTCH---------------------------
   limitSwitch.loop();
     int state = limitSwitch.getState();
    Serial.print("switch pencere: ");
    Serial.println(state);
     
 const int httpPort = 8080;
    if (!client2.connect(host, httpPort)) {
        Serial.println("connection failed");
        return;
    }

 client2.print(String("GET http://192.168.1.55/evotomasyonu/sayfalar/penceredurum.php?") + 
                          ("&Stat=") + state +
                          " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");

  
  //--------------------PENCERE SWİTCH---------------------------
    //--------------------KAPI SWİTCH---------------------------
   limitSwitch2.loop();
     int state2 = limitSwitch2.getState();
    Serial.print("switch kapı: ");
    Serial.print(state2);
     
 const int httpPort2 = 8080;
    if (!client4.connect(host2, httpPort2)) {
        Serial.println("connection failed");
        return;
    }

 client4.print(String("GET http://192.168.1.55/evotomasyonu/sayfalar/penceredurum2.php?") + 
                          ("&Stat=") + state2 +
                          " HTTP/1.1\r\n" +
                 "Host: " + host2 + "\r\n" +
                 "Connection: close\r\n\r\n");
  //--------------------KAPI SWİTCH---------------------------
 
     
      


  
  
   }

 
    
}
