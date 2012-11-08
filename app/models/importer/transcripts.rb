require 'open-uri'
require 'iconv'

module Importer
  class Transcripts
    TRANSCRIPT_BASE_URL = "http://www.bbc.co.uk/ahistoryoftheworld/about/transcripts/episode%s/".freeze

    def process
      Artifact.find_each do |artifact|
        url = TRANSCRIPT_BASE_URL % [artifact.number]
        doc = Nokogiri::HTML(open(url))

        transcript = doc.css(".col-a p").map {|element| element.text}.join("\n")
        artifact.transcript = Iconv.conv("UTF-8//IGNORE", "US-ASCII", transcript)
        artifact.save!
      end
    end

  end
end