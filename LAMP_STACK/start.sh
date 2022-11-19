# The following code is to found the pwd of this bash file
PRG="$0"
while [ -h "$PRG" ] ; do
  # shellcheck disable=SC2006
  ls=`ls -ld "$PRG"`
  # shellcheck disable=SC2006
  link=`expr "$ls" : '.*-> \(.*\)$'`
  if expr "$link" : '/.*' > /dev/null; then
    PRG="$link"
  else
    # shellcheck disable=SC2006
    PRG=`dirname "$PRG"`/"$link"
  fi
done
# shellcheck disable=SC2046
# shellcheck disable=SC2164
cd $(cd $(dirname "$PRG"); pwd)

# Activate the docker compose
docker-compose up --build
