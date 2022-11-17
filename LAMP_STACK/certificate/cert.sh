# Create CA certificate for https
openssl req -newkey rsa:2048 -new -nodes -x509 -days 3650 -keyout cert-key.pem -out cert.pem
openssl rsa -outform der -in cert-key.pem -out cert.key

