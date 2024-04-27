FROM public.ecr.aws/docker/library/python:slim-bullseye
LABEL authors="ar.saffariyan@gmail.com"

COPY ./requirements.txt /tmp/requirements.txt
COPY ./src /src

WORKDIR src
EXPOSE 8000

RUN pip install --no-cache-dir -r /tmp/requirements.txt
