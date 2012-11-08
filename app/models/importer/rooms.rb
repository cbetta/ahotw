require 'open-uri'

module Importer
  class Rooms

    def process
      Artifact.find_each do |artifact|
        doc = Nokogiri::HTML(open(artifact.british_museum_url))

        doc.css(".bd p").each do |element|
          if element.text.match(/rooms? (\d+-?\d+)?/i)
            artifact.room = element.text.match(/rooms? (\d+-?\d*)?/i)[1]
          end
        end

        if artifact.room
          location_link = doc.css(".mediaBlock .arrowRight").first["href"]
          if location_link == '/visiting/floor_plans_and_galleries/upper_floor.aspx'
            artifact.floor = "Upper Floor"
          elsif location_link == '/visiting/floor_plans_and_galleries/lower_floor.aspx'
            artifact.floor = "Lower Floor"
          elsif location_link == '/visiting/floor_plans_and_galleries/ground_floor.aspx'
            artifact.floor = "Ground Floor"
          end
        end

        artifact.save!
      end
    end


  end
end