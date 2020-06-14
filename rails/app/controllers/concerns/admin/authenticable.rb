module Admin::Authenticable
  extend ActiveSupport::Concern

  included do
    before_action :require_jwt
  end

  def require_jwt
    unless user = Admin::User.auth(jwt)
      render file: "public/401.html", status: :unauthorized unless Admin::User.auth(jwt)
    else
      @user = user
    end
  end

  def secret_key
    "example_key"
  end

  def jwt
    JWT.decode jwt_cookie, secret_key, true, { algorithm: 'HS256' } if jwt_cookie
  end

  def jwt_cookie
    cookies[Admin::User::JWT_COOKIE_KEY] || ""
  end
end
