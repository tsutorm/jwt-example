class Admin::User < ApplicationRecord

  JWT_COOKIE_KEY = "admin-session".to_sym

  def self.auth(jwt_json)
    body, head = jwt_json
    Time.zone.now < Time.zone.at(body["exp"])
    self.new
  end

end
