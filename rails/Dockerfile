FROM ruby:2.7.1-slim

WORKDIR /app

RUN apt update && apt -y install git make gcc libxml2 libxml2-dev libmariadb-dev libmariadb3 mariadb-client


COPY Gemfile /app/Gemfile
COPY Gemfile.lock /app/Gemfile.lock

RUN bundle config path vendor/bundle && \
    bundle install

CMD ["bundle", "exec", "rails", "s", "-b", "0.0.0.0", "-p", "3000"]
