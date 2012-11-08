require 'open-uri'

module Importer
  class Wikipedia

    WIKIPEDIA_URL = "http://en.wikipedia.org/wiki/A_History_of_the_World_in_100_Objects"

    def process
      Artifact.delete_all

      doc = Nokogiri::HTML(open(WIKIPEDIA_URL))
      doc.css(".wikitable").each do |table|
        table.css("tr").each_with_index do |row, i|
          next if i == 0

          @artifact = Artifact.new

          cells = row.css("td")
          @artifact.image_url           = parse_image_url(cells[0])
          @artifact.number              = cells[1].text
          @artifact.name                = cells[2].text
          @artifact.wikipedia_url       = parse_wikipedia_url(cells[2])
          @artifact.origin              = cells[3].text
          @artifact.origin_url          = parse_wikipedia_url(cells[3])
          @artifact.bbc_url             = parse_url(cells[5])
          @artifact.date                = cells[4].text

          @artifact.save!
        end
      end
    end

    def parse_image_url cell
      cell.css("img").first ? "http:"+cell.css("img").first["src"] : nil
    end

    def parse_wikipedia_url cell
      cell.css("a").first ? "http://en.wikipedia.org"+cell.css("a").first["href"] : nil
    end

    def parse_url cell
      cell.css("a").first ? cell.css("a").first["href"] : nil
    end
  end
end