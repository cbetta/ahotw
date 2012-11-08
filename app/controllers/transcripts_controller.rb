class TranscriptsController < ApplicationController

  def show
    @artifact = Artifact.find_by_number(params[:id])
  end

end
