Ahotw::Application.routes.draw do
  resources :artifacts
  root :to => 'artifacts#index'
end
