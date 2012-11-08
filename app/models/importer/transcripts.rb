require 'open-uri'
require 'iconv'

module Importer
  class Transcripts
    TRANSCRIPT_BASE_URL = "http://www.bbc.co.uk/ahistoryoftheworld/about/transcripts/episode%s/".freeze

    def process
      Artifact.find_each do |artifact|
        url = TRANSCRIPT_BASE_URL % [artifact.number]
        doc = Nokogiri::HTML(open(url))
        artifact.transcript = doc.css(".col-a p").map {|element| Iconv.conv("UTF-8//IGNORE", "US-ASCII", element.text).gsub("\n", "") }.join("\n")

        artifact.save!
      end
    end

  end
end