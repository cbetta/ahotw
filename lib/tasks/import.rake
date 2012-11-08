namespace :import do
  desc "Imports all the data"
  task :all => :environment do
    Rake::Task['import:wikipedia'].invoke
  end

  desc "Imports the data from Wikipedia"
  task :wikipedia => :environment do
    Importer::Wikipedia.new.process
  end
end