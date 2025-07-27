#include <WiFi.h>
#include <HTTPClient.h>

HTTPClient http;
WiFiClient client;

const char *ssid = "KAMBOJA 14 Belakang";
const char *password = "kosbelakang14";

const char *url = "http://192.168.100.13/doorlock/test-esp.php";

//String apiKeyValue = "tPmAT5Ab3j7F9";

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
  if (WiFi.status() == WL_CONNECTED) {
    http.begin(client, url);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    int responseValue = http.get();
    String response = http.getString();

    if (responseValue == 200) {
      Serial.print("Post Data Succeced : ");
      Serial.println(responseValue);
      Serial.println(response);
    } else {
      Serial.print("There is an error : ");
      Serial.println(responseValue);
    }

    http.end();
  }
  delay(1000);
}
