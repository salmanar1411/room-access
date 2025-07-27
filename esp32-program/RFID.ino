#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN_1 21    // Pin SDA modul RFID 1
#define RST_PIN_1 22   // Pin RST modul RFID 1

#define SS_PIN_2 26     // Pin SDA modul RFID 2
#define RST_PIN_2 25    // Pin RST modul RFID 2

MFRC522 rfid1(SS_PIN_1, RST_PIN_1); // Instance untuk modul RFID 1
MFRC522 rfid2(SS_PIN_2, RST_PIN_2); // Instance untuk modul RFID 2

void setup() {
  Serial.begin(115200);      // Inisialisasi serial
  SPI.begin();               // Inisialisasi SPI
  rfid1.PCD_Init();          // Inisialisasi RFID 1
  rfid2.PCD_Init();          // Inisialisasi RFID 2
  Serial.println("Scan RFID tag");
}

String readRFID(MFRC522 &rfid) {
  // Periksa apakah ada kartu yang terdeteksi
  if (!rfid.PICC_IsNewCardPresent() || !rfid.PICC_ReadCardSerial()) {
    return ""; // Tidak ada kartu
  }

  // Baca UID dari kartu
  String uid = "";
  for (byte i = 0; i < rfid.uid.size; i++) {
    uid += (rfid.uid.uidByte[i] < 0x10 ? "0" : "") + String(rfid.uid.uidByte[i], HEX);
  }
  uid.toUpperCase(); // Konversi UID ke huruf besar

  // Hentikan komunikasi dengan kartu
  rfid.PICC_HaltA();
  rfid.PCD_StopCrypto1();

  return uid;
}

void loop() {
  // Baca RFID dari modul 1
  String uid1 = readRFID(rfid1);
  if (uid1 != "") {
    Serial.print("RFID 1 Detected: ");
    Serial.println(uid1);
  }

  // Baca RFID dari modul 2
  String uid2 = readRFID(rfid2);
  if (uid2 != "") {
    Serial.print("RFID 2 Detected: ");
    Serial.println(uid2);
  }

  delay(500); // Delay untuk menghindari pembacaan berulang terlalu cepat
}
