module Importer
  class Images

    def process
      Artifact.order(:number).find_each do |artifact|
        next if artifact.image_url.nil?
        image = MiniMagick::Image.open(artifact.image_url)
        image = resize_and_crop(image, 80)
        image.format "jpg"
        image.write "public/objects/#{artifact.number}.jpg"
      end
    end

    def resize_and_crop(image, size)
      if image[:width] < image[:height]
        remove = ((image[:height] - image[:width])/2).round
        image.shave("0x#{remove}")
      elsif image[:width] > image[:height]
        remove = ((image[:width] - image[:height])/2).round
        image.shave("#{remove}x0")
      end
      image.resize("#{size}x#{size}")
      return image
    end
  end
end