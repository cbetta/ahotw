class MapsController < ApplicationController

  MAPS = {
    "upper_floor"   => "http://www.britishmuseum.org/images/upper_floor071111.gif",
    "lower_floor"   => "http://www.britishmuseum.org/images/lowerfloor.gif",
    "ground_floor"  => "http://www.britishmuseum.org/images/groundfloor.gif"
  }

  def show
    @map = MAPS[params[:id]]
  end

end
