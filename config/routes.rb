Ahotw::Application.routes.draw do
  resources :artifacts
  resources :transcripts
  resources :maps

  root :to => 'artifacts#index'
end
