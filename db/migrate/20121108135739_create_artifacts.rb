class CreateArtifacts < ActiveRecord::Migration
  def change
    create_table :artifacts do |t|
      t.column :number, :integer
      t.column :description, :text
      t.column :name, :string
      t.column :origin, :string
      t.column :date, :string
      t.column :image_url, :text
      t.column :origin_url, :string
      t.column :wikipedia_url, :string
      t.column :bbc_url, :string
      t.column :british_museum_url, :string
      t.column :audio_url, :string
      t.column :transcript, :text
      t.column :floor, :string
      t.column :room, :string

      t.timestamps
    end
  end
end
