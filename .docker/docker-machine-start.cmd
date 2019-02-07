REM Starting Docker
docker-machine start default
REM Mounting share folder ("code")
docker-machine ssh default "sudo mkdir /code && sudo mount -t vboxsf code /code && sudo chmod 0777 -R /code"
REM Starting Docker Compose
cd ../
docker-compose up -d