# Change log
All notable changes to this project is writing here

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