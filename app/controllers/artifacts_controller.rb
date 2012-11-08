class ArtifactsController < ApplicationController

  def index

  end

  def show
    @artifact = Artifact.find_by_number(params[:id])
  end

end
