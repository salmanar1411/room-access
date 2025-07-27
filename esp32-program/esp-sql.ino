#include <WiFi.h>
#include <HTTPClient.h>
#include <ArduinoJson.h>

HTTPClient http;
WiFiClient client;

const char *ssid = "Koneksi HOTSPOT KOMINFO RI";
const char *password = "memetjmk";

const char *url = "http://192.168.189.78/doorlock/to-esp.php";

//String apiKeyValue = "tPmAT5Ab3j7F9";

void from_sql(){
  http.begin(url);
  int httpStatus = http.GET();

  if (httpStatus == 200){
    String payload = http.getString();
    Serial.print("Data dari SQL:");
    Serial.println(payload);

    StaticJsonDocument<200> doc;

    DeserializationError error = deserializeJson(doc, payload);
    if(!error){
      String angka1 = doc["num1"];
      Serial.print("data angka1: ");
      Serial.println(angka1.toInt());
    }
    else {
      Serial.println("Gagal parsing data");
    }
  }
  else {
    Serial.println("Data tidak ada");
  }

  http.end();
}

void setup() {
  // put your setup code here, to run once:
  Serial.begin(115200);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(1000);
  }
  Serial.println("WiFi Connected");

}

void loop() {
//  int num1 = random(0, 100);
//  int num2 = random(100, 200);
//
////  String data = "api_key=" + apiKeyValue + "&num1=" + String(num1) + "&num2=" + String(num2);
//  String data = "num1=" + String(num1) + "&num2=" + String(num2);
//
//  if (WiFi.status() == WL_CONNECTED) {
//    http.begin(client, url);
//    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
//    int responseValue = http.POST(data);
////    String response = http.getString();
//
//    if (responseValue == 200) {
//      Serial.print("Post Data Succeced : ");
//      Serial.println(responseValue);
//    } else {
//      Serial.print("There is an error : ");
//      Serial.println(responseValue);
//    }
//
//    http.end();
//  }

  from_sql();
  
  delay(1000);
}
