namespace :import do
  desc "Imports all the data"
  task :all => :environment do
    Rake::Task['import:wikipedia'].invoke
    Rake::Task['import:bbc'].invoke
    Rake::Task['import:transcripts'].invoke
    Rake::Task['import:rooms'].invoke
    # Rake::Task['import:images'].invoke
  end

  desc "Imports the data from Wikipedia"
  task :wikipedia => :environment do
    Importer::Wikipedia.new.process
  end

  desc "Imports the data from the BBC"
  task :bbc => :environment do
    Importer::BBC.new.process
  end

  desc "Imports the transcripts from the BBC"
  task :transcripts => :environment do
    Importer::Transcripts.new.process
  end

  desc "Imports the room data from the British Museum site"
  task :rooms => :environment do
    Importer::Rooms.new.process
  end

  desc "Imports the images"
  task :images => :environment do
    Importer::Images.new.process
  end
end