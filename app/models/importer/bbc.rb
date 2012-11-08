require 'open-uri'

module Importer
  class BBC

    def process
      Artifact.find_each do |artifact|
        doc = Nokogiri::HTML(open(artifact.bbc_url))
        artifact.audio_url = process_url(doc.css(".download a"))
        artifact.description = doc.css(".object-description").first.text
        artifact.british_museum_url = process_url(doc.css("li.mysite a"))
        artifact.save!
      end
    end

    def process_url element
      element.first ? element.first["href"] : nil
    end

  end
end