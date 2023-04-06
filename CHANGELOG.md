# Change log
All notable changes to this project is writing here

## [0.0.9] - 2023-04-06

### Added
- Can accept custom medias list in gallery component
- Client crud
- Twig extension to get media url
- Prepare a custom field to choose a media from the gallery

### Changed
- Refactor code to get only 1 place to get media url

## [0.0.8] - 2023-04-05

### Added
- Add navbar in admin
- Add, edit, new tag
- Add autocomplete tag field for project and job

### Fixed
- Fix migration failed when start a new project
- Fix missing migration for project_media
- Fix timestampable doesn't work with embeddable
- Fix missing import bootstrap js

## [0.0.7] - 2023-04-04

### Added
- Word management
- Word category management
- Messages flashed in admin

### Changed
- Typed element in homepage become component

### Fixed
- Fix svg missing

## [0.0.6] - 2023-04-04

### Added
- Handle different mime type

### Changed
- Use grid instead of flex for medias
- Media component css is independant

### Fixed
- Remove dump

## [0.0.5] - 2023-04-04

### Added
- Ignore docs folder
- Ignore public/uploads folder
- Add profile picture on homepage
- Add default value for createdAt field
- Add media admin index and new with dropzone

### Changed
- Add margin top to the body
- Change media size property type to int
- Rename field media type to mimetype

### Fixed
- H2 font size

## [0.0.4] - 2023-04-04

### Added
- Add typed words on homepage
- Media entity
- Client entity
- Medias in job, project
- Slugs

### Changed
- Rename name => path in media

### Fixed
- Updated_at in detail


## [0.0.3] - 2023-04-04

### Added
- Create Project entity
- Trait, interface and embeddable for detail content
- Homepage structure and design

### Changed
- Use trait and embeddable for Job entity's details

### Fixed
- Missing implements interface DetailInterface for Job and Project

## [0.0.2] - 2023-03-13

### Added
- Add getFullName method
- Add job entity
- Add tag entity
- Create ManyToMany relationship between job and tag

## [0.0.1] - 2023-03-13

### Added
- Webpack encore
- Bootstrap 5
- User
- Login System
- Fixtures
  - User
- Homepage
- Roles
  - ROLE_ADMIN
  - ROLE_ADMIN_ACCESS
  - ROLE_SUPER_ADMIN
  - ROLE_TEST
  - ROLE_USER
- Limit access to admin pages only with tole ROLE_ADMIN_ACCESS