
#### [Current]

#### 
 * [e3a5319](../../commit/e3a5319) - __(Michael Roterman)__ Adding the video method, fixes [#24](../../issues/24)
 * [d3a4041](../../commit/d3a4041) - __(Michael Roterman)__ Making the getTrailers method in Movies deprecated since this is being replaced by videos.
 * [e0cf947](../../commit/e0cf947) - __(Michael Roterman)__ Adding videos method on the API scope.
 * [4d92a83](../../commit/4d92a83) - __(Michael Roterman)__ Removing hardcoded log paths from the examples.
 * [1baed86](../../commit/1baed86) - __(Michael Roterman)__ Adding the username and password authentication method for authentication.
 * [7f732a8](../../commit/7f732a8) - __(Michael Roterman)__ Complying with the API.
 * [78864fd](../../commit/78864fd) - __(Michael Roterman)__ Implemented first citizen for GuestSession's, fixes [#20](../../issues/20)
 * [d458133](../../commit/d458133) - __(Michael Roterman)__ Implemented Timezones first citizen, fixes [#19](../../issues/19).
 * [93842bb](../../commit/93842bb) - __(Michael Roterman)__ Adding test
 * [78de26f](../../commit/78de26f) - __(Michael Roterman)__ Adding timezone first citizen for API
 * [4c20afe](../../commit/4c20afe) - __(Michael Roterman)__ Typo
 * [42dfae7](../../commit/42dfae7) - __(Michael Roterman)__ Improving the way https is enabled.
 * [ff6c4e1](../../commit/ff6c4e1) - __(Michael Roterman)__ Adding CHANGELOG.md
 * [3d6b85f](../../commit/3d6b85f) - __(Michael Roterman)__ Make sure any __toString modification meets the requirements.
 * [2f3150f](../../commit/2f3150f) - __(Michael Roterman)__ Adding airing_today and fixing tests for on_the_air, fixes [#23](../../issues/23) and thus can be closed
 * [ef7af10](../../commit/ef7af10) - __(Michael Roterman)__ Fixing issue when the response from TMDB is null.
 * [7cd5ea2](../../commit/7cd5ea2) - __(Michael Roterman)__ Adding clear list functionality, fixes [#22](../../issues/22) and thus can be closed.
 * [90eaa28](../../commit/90eaa28) - __(Michael Roterman)__ Preparing v1.0.0
 * [bcfad0a](../../commit/bcfad0a) - __(Michael Roterman)__ Removing version because it does not exist at travis.
 * [dc09c77](../../commit/dc09c77) - __(Michael Roterman)__ Fixing issues with previous commit
 * [c900d2f](../../commit/c900d2f) - __(Michael Roterman)__ Fixing an issue where an Image object should be present but it was not.
 * [1bd0c9b](../../commit/1bd0c9b) - __(Michael Roterman)__ Updating composer
 * [9144b4d](../../commit/9144b4d) - __(Michael Roterman)__ Updating readme
 * [cab75ae](../../commit/cab75ae) - __(Michael Roterman)__ Typo
 * [865d26f](../../commit/865d26f) - __(Michael Roterman)__ Fixing typo
 * [9806a6f](../../commit/9806a6f) - __(Michael Roterman)__ Adding a bunch of examples for the API section, and fixing a missing method in Tv ( getOnTheAir ).
 * [60b95e4](../../commit/60b95e4) - __(Michael Roterman)__ Fixes
 * [7287fe2](../../commit/7287fe2) - __(Michael Roterman)__ Add missing method in TV API.
 * [3de3bc6](../../commit/3de3bc6) - __(Michael Roterman)__ Adding more examples for Tv.
 * [d9a1e22](../../commit/d9a1e22) - __(Michael Roterman)__ Fix wrong reference.
 * [649f224](../../commit/649f224) - __(Michael Roterman)__ Adding examples for Tv.
 * [6a70621](../../commit/6a70621) - __(Michael Roterman)__ Adding examples for search.
 * [9bf4ea7](../../commit/9bf4ea7) - __(Michael Roterman)__ Adding example for reviews.
 * [31d3629](../../commit/31d3629) - __(Michael Roterman)__ Adding examples for person.
 * [3b4eabe](../../commit/3b4eabe) - __(Michael Roterman)__ Adding example for network.
 * [facf924](../../commit/facf924) - __(Michael Roterman)__ Adding examples for movies.
 * [b95a318](../../commit/b95a318) - __(Michael Roterman)__ Adding and updating examples for lists.
 * [c7c2faa](../../commit/c7c2faa) - __(Michael Roterman)__ Adding examples for keywords.
 * [7b7f36b](../../commit/7b7f36b) - __(Michael Roterman)__ Adding example for jobs.
 * [2b1ec4d](../../commit/2b1ec4d) - __(Michael Roterman)__ Adding examples for genres.
 * [a1e54e7](../../commit/a1e54e7) - __(Michael Roterman)__ Adding example for find.
 * [b78538e](../../commit/b78538e) - __(Michael Roterman)__ Adding examples for discover.
 * [b5064ca](../../commit/b5064ca) - __(Michael Roterman)__ Adding example for configuration.
 * [620bd24](../../commit/620bd24) - __(Michael Roterman)__ Adding examples for collection.
 * [f7ea433](../../commit/f7ea433) - __(Michael Roterman)__ Adding examples for changes.
 * [4b04471](../../commit/4b04471) - __(Michael Roterman)__ Adding examples for companies.
 * [57d9680](../../commit/57d9680) - __(Michael Roterman)__ Adding psr/log interfaces to the require block of composer.
 * [2b28284](../../commit/2b28284) - __(Michael Roterman)__ Modify behaviour of the ImageHelper, which now supports string input, and adding missing credit_id parameters in cast and crewmember objects.
 * [d443ad6](../../commit/d443ad6) - __(Michael Roterman)__ Allowing to input the file_path's in string format in the ImageHelper methods `getUrl`, `getHtml` as this helper should also support the array approach.
 * [20a3507](../../commit/20a3507) - __(Michael Roterman)__ Adding credit_id
 * [cc0ec44](../../commit/cc0ec44) - __(Michael Roterman)__ Adding username and password authentication, failes for some reason and added an ticket at TMDB API http://tmdb.lighthouseapp.com/projects/83077-api/tickets/358-improve-authentication-api#ticket-358-8.

I suspect the api_key has to be ignored from the request as the request matches the earlier discussion in this ticket,
but this would require extra work and actually doesn't make sense as all other authentication requests do require the api_key.

 * [b676689](../../commit/b676689) - __(Michael Roterman)__ Changing suggest descriptions in composer.json
 * [6a2e7b2](../../commit/6a2e7b2) - __(Michael Roterman)__ Adding plug-ins section
 * [0c309c7](../../commit/0c309c7) - __(Michael Roterman)__ Adding features block in README.md
 * [ff51a4b](../../commit/ff51a4b) - __(Michael Roterman)__ Adding features block in README.md
 * [88fe478](../../commit/88fe478) - __(Michael Roterman)__ Fixing more typo's
 * [28af261](../../commit/28af261) - __(Michael Roterman)__ Typo
 * [a6f8819](../../commit/a6f8819) - __(Michael Roterman)__ Typo in example
 * [a1a4ca9](../../commit/a1a4ca9) - __(Michael Roterman)__ Typo
 * [1eeb971](../../commit/1eeb971) - __(Michael Roterman)__ Cleaning up some aspects of the API, as removing the TV\Network class and moving it into it's first citizen class Network ( since TMDB added this ).

Also added travis support for php 5.6, and hhvm ( not officially supported though ).

 * [57c7b7b](../../commit/57c7b7b) - __(Michael Roterman)__ Updating README
 * [158dbc8](../../commit/158dbc8) - __(Michael Roterman)__ Updating travis ci for php 5.6 and hhvm.
 * [d5986f7](../../commit/d5986f7) - __(Michael Roterman)__ Fix references
 * [a480e98](../../commit/a480e98) - __(Michael Roterman)__ Removing deprecated Tv\Network class, TMDB moved this up to a top resident.
 * [c6ec372](../../commit/c6ec372) - __(Michael Roterman)__ Fixing unit tests of Network
 * [bc8be43](../../commit/bc8be43) - __(Michael Roterman)__ Small issues / improvements.
 * [8ebbbed](../../commit/8ebbbed) - __(Michael Roterman)__ Fixing some issues
 * [857fde8](../../commit/857fde8) - __(Michael Roterman)__ Adding logging functionality, requires monolog to be installed.
 * [728e3b3](../../commit/728e3b3) - __(Michael Roterman)__ Adding BackoffRetryPlugin from Guzzle.
 * [9ad1153](../../commit/9ad1153) - __(Michael Roterman)__ Updating README
 * [a310041](../../commit/a310041) - __(Michael Roterman)__ Implements caching capabilities with examples ( requires `doctrine-cache` ) and PSR compatibility. I've also added a generic build script to obtain some metrics and generated documentation.
 * [5f03c04](../../commit/5f03c04) - __(Michael Roterman)__ Adding some basic caching functionality, requires to include `doctrine-cache` in your composer.json.
 * [d6d7221](../../commit/d6d7221) - __(Michael Roterman)__ Adding unit tests for caching
 * [5caa082](../../commit/5caa082) - __(Michael Roterman)__ Adding default simple implementation for cache, it adheres to the headers sent by TMDB.
 * [a3a298f](../../commit/a3a298f) - __(Michael Roterman)__ Making sure the last response and requests are available.
 * [ab4572f](../../commit/ab4572f) - __(Michael Roterman)__ Add the HttpClient to the phpdoc to provide auto-completion
 * [3de15b1](../../commit/3de15b1) - __(Michael Roterman)__ Adding doctrine cache to the suggest directive in composer.json to indicate cache support, also added an example of how this could be used.
 * [2c19c97](../../commit/2c19c97) - __(Michael Roterman)__ PSR compliance.
 * [1e5a7b7](../../commit/1e5a7b7) - __(Michael Roterman)__ PSR-0 compatibility
 * [c2bef1d](../../commit/c2bef1d) - __(Michael Roterman)__ Running php-cs-fixer
 * [dadc395](../../commit/dadc395) - __(Michael Roterman)__ Adding seperate build script to supply api docs, coverage and other metrics.
 * [2c2a12e](../../commit/2c2a12e) - __(Michael Roterman)__ Adding a seperate build script to compile api docs and run coverage and other metrics.
 * [8c3ae4a](../../commit/8c3ae4a) - __(Michael Roterman)__ Adding build related files and modified phpunit coverage
 * [4be539c](../../commit/4be539c) - __(Michael Roterman)__ Updating gitignore
 * [e5e04fa](../../commit/e5e04fa) - __(Michael Roterman)__ Removing getKey from the abstract class as subclasses are obliged to implement this.
 * [898afc5](../../commit/898afc5) - __(Michael Roterman)__ Removing the factory interface and adjusting the AbstractFactory, do not see a reason to keep this interface.
 * [9843ea8](../../commit/9843ea8) - __(Michael Roterman)__ Remove this test for time being, just want to make sure the builds on different versions of php are stable now. Will get back to this later :-).
 * [d652bb5](../../commit/d652bb5) - __(Michael Roterman)__ More fixes
 * [34f31b0](../../commit/34f31b0) - __(Michael Roterman)__ Fixing jobs collection and tests
 * [3f42dc7](../../commit/3f42dc7) - __(Michael Roterman)__ Fixing failing test
 * [290550e](../../commit/290550e) - __(Michael Roterman)__ Fixing the rest of the relevant issues to PR-14
 * [e7ca9f3](../../commit/e7ca9f3) - __(Joel Wurtz)__ Add composer install to travis script

Actually no tests are executed on travis as travis does not run composer install anymore by default
 * [2b3a6db](../../commit/2b3a6db) - __(Michael Roterman)__ Fixing composer.json
 * [40096a5](../../commit/40096a5) - __(Michael Roterman)__ Fixing composer.json
 * [97143d0](../../commit/97143d0) - __(Michael Roterman)__ Point composer to dev-master for now
 * [7a49fc2](../../commit/7a49fc2) - __(Michael Roterman)__ Updating README.md
 * [5436df8](../../commit/5436df8) - __(Michael Roterman)__ Updating composer.json
 * [7a8405d](../../commit/7a8405d) - __(Michael Roterman)__ Adding some more examples for people and fixing some issues
 * [6078fbe](../../commit/6078fbe) - __(Michael Roterman)__ Updating README and PeopleRepository
 * [3ebc6b4](../../commit/3ebc6b4) - __(Michael Roterman)__ Clean up
 * [e13bb4b](../../commit/e13bb4b) - __(Michael Roterman)__ Verifying ResultCollections are present where they should be.
 * [077f8e7](../../commit/077f8e7) - __(Michael Roterman)__ Adding phpdox configuration
 * [56364bf](../../commit/56364bf) - __(Michael Roterman)__ Updating gitignore
 * [2eb61b9](../../commit/2eb61b9) - __(Michael Roterman)__ Adding docblocks
 * [411104d](../../commit/411104d) - __(Michael Roterman)__ Adding documentation uri's
 * [ba297c0](../../commit/ba297c0) - __(Michael Roterman)__ Merge pull request [#13](../../issues/13) from wtfzdotnet/feature-authentication

Implemented account related features
 * [ddc0af3](../../commit/ddc0af3) - __(Michael Roterman)__ Updating unit tests
 * [e62f084](../../commit/e62f084) - __(Michael Roterman)__ Adding the rest of Account related methods
 * [53f109c](../../commit/53f109c) - __(Michael Roterman)__ Adding account related methods
 * [d958f28](../../commit/d958f28) - __(Michael Roterman)__ Implementing Lists API into the modelled sections
 * [382b694](../../commit/382b694) - __(Michael Roterman)__ Fixing unit tests
 * [dbfbe85](../../commit/dbfbe85) - __(Michael Roterman)__ Implementing account related Lists methods
 * [5e0541d](../../commit/5e0541d) - __(Michael Roterman)__ Implementing remaining methods
 * [2a16170](../../commit/2a16170) - __(Michael Roterman)__ Implementing more account related functionality
 * [6ff4e31](../../commit/6ff4e31) - __(Michael Roterman)__ Implemented functions into the Account API, just adding movies to a watchlist or favoriting them does not function, need to get back at this later.
 * [f64a18a](../../commit/f64a18a) - __(Michael Roterman)__ Implementing lists
 * [b1fdc7d](../../commit/b1fdc7d) - __(Michael Roterman)__ Getting green
 * [401550b](../../commit/401550b) - __(Michael Roterman)__ First working version of communication with account
 * [b8f2174](../../commit/b8f2174) - __(Michael Roterman)__ Adding guest_session
 * [2cdb1a7](../../commit/2cdb1a7) - __(Michael Roterman)__ Worked up to acquiring sessions, implementation of account related functions to follow after we get the plugin done.
 * [a8c2cc4](../../commit/a8c2cc4) - __(Michael Roterman)__ Added RequestToken in the API and preparing modelling.
 * [41524a5](../../commit/41524a5) - __(Michael Roterman)__ Adding SessionToken and implementing it into the Client
 * [b49f91e](../../commit/b49f91e) - __(Michael Roterman)__ Updating README
 * [98c8919](../../commit/98c8919) - __(Michael Roterman)__ Cleaning up the README
 * [2b44648](../../commit/2b44648) - __(Michael Roterman)__ Clean up
 * [af4f434](../../commit/af4f434) - __(Michael Roterman)__ Renaming
 * [ae88a75](../../commit/ae88a75) - __(Michael Roterman)__ Adding the LanguageFilterPlugin
 * [cf0e604](../../commit/cf0e604) - __(Michael Roterman)__ Refactoring ApiTokenPlugin
 * [d334cc1](../../commit/d334cc1) - __(Michael Roterman)__ Adding the adult filter plugin
 * [a08391a](../../commit/a08391a) - __(Michael Roterman)__ Update README, make the header title less screaming
 * [40298c1](../../commit/40298c1) - __(Michael Roterman)__ Adding versioneye dependency status.
 * [4804868](../../commit/4804868) - __(Michael Roterman)__ Updating MovieFactory to actually use the ReviewFactory::createCollection method
 * [5201ced](../../commit/5201ced) - __(Michael Roterman)__ Removing backdrop_path from lists as it should not be here.
 * [3362cf9](../../commit/3362cf9) - __(Michael Roterman)__ Updating TvSeasonRepositoryTest
 * [6b67c60](../../commit/6b67c60) - __(Michael Roterman)__ Updating TvEpisodeRepository
 * [c134d5d](../../commit/c134d5d) - __(Michael Roterman)__ Updating SearchRepositoryTest
 * [bcacadc](../../commit/bcacadc) - __(Michael Roterman)__ Updating MovieRepositoryTest and fixing a bug.
 * [70f51aa](../../commit/70f51aa) - __(Michael Roterman)__ Updating PeopleRepositoryTest
 * [b6a06ab](../../commit/b6a06ab) - __(Michael Roterman)__ Updating GenreRepositoryTest
 * [97d2232](../../commit/97d2232) - __(Michael Roterman)__ Updating CollectionRepositoryTest
 * [c1a2e68](../../commit/c1a2e68) - __(Michael Roterman)__ Updating MovieRepositoryTest and fixing some issues in MovieFactory
 * [3c11382](../../commit/3c11382) - __(Michael Roterman)__ Updating TvRepositoryTest
 * [3b6d993](../../commit/3b6d993) - __(Michael Roterman)__ Bugfix
 * [63d3bfc](../../commit/63d3bfc) - __(Michael Roterman)__ Cleanup
 * [674b13d](../../commit/674b13d) - __(Michael Roterman)__ Cleanup
 * [4c1f1b6](../../commit/4c1f1b6) - __(Michael Roterman)__ Adding SearchRepositoryTest
 * [56c161e](../../commit/56c161e) - __(Michael Roterman)__ Allow search queries to be left empty, leave the responsibility to meet minimum parameters up to the end-user.
 * [4f9e644](../../commit/4f9e644) - __(Michael Roterman)__ Updating ListRepositoyTest to cover ListItems and updated docblocks in ListRepository
 * [2984be9](../../commit/2984be9) - __(Michael Roterman)__ Adding ListRepositoryTest
 * [7870f85](../../commit/7870f85) - __(Michael Roterman)__ Adding CreditsRepositoryTest and removing unused methods
 * [d043fae](../../commit/d043fae) - __(Michael Roterman)__ Adding CertificationRepositoryTest
 * [43cbed5](../../commit/43cbed5) - __(Michael Roterman)__ Adding KeywordRepositoryTest
 * [1a81162](../../commit/1a81162) - __(Michael Roterman)__ Adding ReviewRepositoryTest
 * [f18bbad](../../commit/f18bbad) - __(Michael Roterman)__ Adding NetworkRepositoryTest
 * [46be396](../../commit/46be396) - __(Michael Roterman)__ Formatting
 * [bc1e845](../../commit/bc1e845) - __(Michael Roterman)__ Unit tests for Lists
 * [8df2440](../../commit/8df2440) - __(Michael Roterman)__ Credits Unit Testing
 * [c2be7ec](../../commit/c2be7ec) - __(Michael Roterman)__ Fix API tests
 * [dc4000f](../../commit/dc4000f) - __(Michael Roterman)__ Unit tests for Review also adjusted the MovieFactory
 * [849d9e5](../../commit/849d9e5) - __(Michael Roterman)__ Unit tests for Keyword, and removing unneccasary Movie/Keyword ( updated MovieFactory to reflect this ).
 * [5b21bf5](../../commit/5b21bf5) - __(Michael Roterman)__ Unit Tests for Certification
 * [ff72b62](../../commit/ff72b62) - __(Michael Roterman)__ Bugfixes, make sure the factory always is able to return a valid "Person/Cast/Crew" object.
 * [92ca2a4](../../commit/92ca2a4) - __(Michael Roterman)__ Bugfix
 * [1e96217](../../commit/1e96217) - __(Michael Roterman)__ Fixing ResultCollection
 * [3de1ad9](../../commit/3de1ad9) - __(Michael Roterman)__ Fixing ResultCollection
 * [3312c27](../../commit/3312c27) - __(Michael Roterman)__ Bugfixes
 * [414be8b](../../commit/414be8b) - __(Michael Roterman)__ Updating README.md to reflect current state
 * [37cb54f](../../commit/37cb54f) - __(Michael Roterman)__ Adding Lists API
 * [632c8bf](../../commit/632c8bf) - __(Michael Roterman)__ Updating README.md
 * [ceda422](../../commit/ceda422) - __(Michael Roterman)__ Updating README.md to reflect the current state
 * [32281b9](../../commit/32281b9) - __(Michael Roterman)__ Adding Certification API
 * [fa7bad2](../../commit/fa7bad2) - __(Michael Roterman)__ Adding Credits API and renaming the Credits Collection to CreditsCollection
 * [00f58cb](../../commit/00f58cb) - __(Michael Roterman)__ Fixing TV Shows / Seasons / Episodes
 * [bf1d472](../../commit/bf1d472) - __(Michael Roterman)__ Bugfixes
 * [9586dc6](../../commit/9586dc6) - __(Michael Roterman)__ Adding TV API methods into TvRepository
 * [5d2c907](../../commit/5d2c907) - __(Michael Roterman)__ Adding missing methods for PersonRepository
 * [3c212f0](../../commit/3c212f0) - __(Michael Roterman)__ Adding missing methods in MovieRepository
 * [8acddbb](../../commit/8acddbb) - __(Michael Roterman)__ Adjust message
 * [7d84946](../../commit/7d84946) - __(Michael Roterman)__ Expand docs a very tiny bit
 * [c123853](../../commit/c123853) - __(Michael Roterman)__ Changing the intro, as we don't consider ourselfs so "unstable" anymore.
 * [0148aa8](../../commit/0148aa8) - __(Michael Roterman)__ Make PROGRESS.md a part of README.md
 * [dc27b2e](../../commit/dc27b2e) - __(Michael Roterman)__ Allow scrutinizer more room
 * [c5129cd](../../commit/c5129cd) - __(Michael Roterman)__ Adding Certifications API in the Api namespace.
 * [0bc00e1](../../commit/0bc00e1) - __(Michael Roterman)__ Adding Credits API in the Api namespace.
 * [e2aed78](../../commit/e2aed78) - __(Michael Roterman)__ Marking Search
 * [0a2399f](../../commit/0a2399f) - __(Michael Roterman)__ Adding Search API
 * [86bc64e](../../commit/86bc64e) - __(Michael Roterman)__ Applying review state for lists
 * [3741eb8](../../commit/3741eb8) - __(Michael Roterman)__ Clearing TV Episodes
 * [2854a1e](../../commit/2854a1e) - __(Michael Roterman)__ Clearing TV Seasons
 * [abe4a48](../../commit/abe4a48) - __(Michael Roterman)__ Adding NetworkFactory to TvFactory and removing networks from the $_properties array to prevent regular hydration.
 * [f50bf6f](../../commit/f50bf6f) - __(Michael Roterman)__ Implementing ReviewRepository and adding example.
 * [7eb94e6](../../commit/7eb94e6) - __(Michael Roterman)__ Making Review a first-class citizen
 * [fff3a10](../../commit/fff3a10) - __(Michael Roterman)__ Updating PROGRESS.md
 * [e104cf7](../../commit/e104cf7) - __(Michael Roterman)__ Implementing Network API
 * [ec08a4c](../../commit/ec08a4c) - __(Michael Roterman)__ Adding missing classes for Keyword API, updated PROGRESS.md
 * [74c2695](../../commit/74c2695) - __(Michael Roterman)__ Adding example for the Find API
 * [39cb3f6](../../commit/39cb3f6) - __(Michael Roterman)__ Styling
 * [fdc5529](../../commit/fdc5529) - __(Michael Roterman)__ Updating PROGRESS.md to clarify remaining TODO items.
 * [c97faef](../../commit/c97faef) - __(Michael Roterman)__ Fixing up Genres, added missing Repository method. Updated PROGRESS.md to reflect current state.
 * [8edc085](../../commit/8edc085) - __(Michael Roterman)__ Updating PROGRESS.md
 * [cc4a865](../../commit/cc4a865) - __(Michael Roterman)__ Fixing Discover collection type
 * [baf1706](../../commit/baf1706) - __(Michael Roterman)__ Fixing bug in Company and clearing it
 * [0e0731a](../../commit/0e0731a) - __(Michael Roterman)__ Updating PROGRESS.md
 * [72a22b1](../../commit/72a22b1) - __(Michael Roterman)__ Fix
 * [2305692](../../commit/2305692) - __(Michael Roterman)__ Moving Tv\ExternalIds to Common\ExternalIds and implemented it in Person
 * [38ce990](../../commit/38ce990) - __(Michael Roterman)__ Adding changes to People
 * [3dec74d](../../commit/3dec74d) - __(Michael Roterman)__ Adding Lists in Movies
 * [0da60c8](../../commit/0da60c8) - __(Michael Roterman)__ Adding the reviews section of Movie models
 * [d4e5d7d](../../commit/d4e5d7d) - __(Michael Roterman)__ Refactoring Movie to actually contain the correct model of changes
 * [04ecef8](../../commit/04ecef8) - __(Michael Roterman)__ Adding PROGRESS.md
 * [8ad49a0](../../commit/8ad49a0) - __(Michael Roterman)__ Renaming any image related methods to be more explicit
 * [eb2a91a](../../commit/eb2a91a) - __(Michael Roterman)__ AbstractMember coverage
 * [adfc8dd](../../commit/adfc8dd) - __(Michael Roterman)__ TvEpisode coverage
 * [9c630c9](../../commit/9c630c9) - __(Michael Roterman)__ TvSeason coverage
 * [991e521](../../commit/991e521) - __(Michael Roterman)__ Fixing README examples
 * [b3705b2](../../commit/b3705b2) - __(Michael Roterman)__ Updating scrutinizer to take it easy on big model collections in the root
 * [f9aa81b](../../commit/f9aa81b) - __(Michael Roterman)__ Updating scrutinizer to take it easy on big model collections in the root
 * [c89dc45](../../commit/c89dc45) - __(Michael Roterman)__ Expanding test suite
 * [b07efd4](../../commit/b07efd4) - __(Michael Roterman)__ Updating composer description of the package.
 * [eb0001a](../../commit/eb0001a) - __(Michael Roterman)__ Adding Bitdeli
 * [9ede605](../../commit/9ede605) - __(Michael Roterman)__ More work being done on finishing the test suite
 * [19003d5](../../commit/19003d5) - __(Michael Roterman)__ Removing unnecassary classes related to people
 * [e9254ff](../../commit/e9254ff) - __(Michael Roterman)__ Downsizing Translation
 * [f6d18bc](../../commit/f6d18bc) - __(Michael Roterman)__ Expanding test suite
 * [bf0a0f8](../../commit/bf0a0f8) - __(Michael Roterman)__ Updating TVFactoryTest
 * [3631b47](../../commit/3631b47) - __(Michael Roterman)__ Removing un-used parseHeaders function
 * [a6a529d](../../commit/a6a529d) - __(Michael Roterman)__ Updating example files to be readable
 * [73d9ce5](../../commit/73d9ce5) - __(Michael Roterman)__ Implementing Jobs
 * [0790840](../../commit/0790840) - __(Michael Roterman)__ Fixing up profile_path hydration.
 * [20efc1c](../../commit/20efc1c) - __(Michael Roterman)__ Fixing docblocks
 * [d24e6d1](../../commit/d24e6d1) - __(Michael Roterman)__ Fixing some bugs
 * [589262a](../../commit/589262a) - __(Michael Roterman)__ Fixing up colletions, factories and cleaning up deprecated methods from models.
 * [2d13dc5](../../commit/2d13dc5) - __(Michael Roterman)__ Adjusting credits dependency to latest API changes.
 * [22e3716](../../commit/22e3716) - __(Michael Roterman)__ Updating Collection
 * [98afbf6](../../commit/98afbf6) - __(Michael Roterman)__ Working on more unit tests and fixing irregularities.
 * [c9c8e64](../../commit/c9c8e64) - __(Michael Roterman)__ Fixing up more unit tests
 * [f38feb6](../../commit/f38feb6) - __(Michael Roterman)__ Updating PeopleFactoryTest
 * [ba0bb96](../../commit/ba0bb96) - __(Michael Roterman)__ Updating unit tests
 * [dc8f050](../../commit/dc8f050) - __(Michael Roterman)__ Fixing unit tests
 * [83b48f7](../../commit/83b48f7) - __(Michael Roterman)__ More unit testing
 * [c81e0c7](../../commit/c81e0c7) - __(Michael Roterman)__ Cleaning up the Generic Collection factory
 * [cea794f](../../commit/cea794f) - __(Michael Roterman)__ Adding Find
 * [d3d7331](../../commit/d3d7331) - __(Michael Roterman)__ Fixing overall cosistency
 * [c6e4bfb](../../commit/c6e4bfb) - __(Michael Roterman)__ Reviewing
 * [4d73a02](../../commit/4d73a02) - __(Michael Roterman)__ Removing unused method
 * [609b5c4](../../commit/609b5c4) - __(Michael Roterman)__ Clean up
 * [54ddb38](../../commit/54ddb38) - __(Michael Roterman)__ Adding tests
 * [43253b4](../../commit/43253b4) - __(Michael Roterman)__ Reviewing Models
 * [ad9408b](../../commit/ad9408b) - __(Michael Roterman)__ Adding unit tests
 * [04dc350](../../commit/04dc350) - __(Michael Roterman)__ Adding MovieFactoryTest, and fixing the base TestCase to always return assoc arrays.
 * [5f37923](../../commit/5f37923) - __(Michael Roterman)__ Updating inheritance
 * [7c57e63](../../commit/7c57e63) - __(Michael Roterman)__ Removing headers from the client as it should have nothing to do with it.
 * [f91491b](../../commit/f91491b) - __(Michael Roterman)__ Updating README
 * [0fe2f0f](../../commit/0fe2f0f) - __(Michael Roterman)__ Fix formatting
 * [f5d67ef](../../commit/f5d67ef) - __(Michael Roterman)__ Update readme
 * [dd80a79](../../commit/dd80a79) - __(Michael Roterman)__ Updating readme
 * [36f4c90](../../commit/36f4c90) - __(Michael Roterman)__ Clean up
 * [f73fc2a](../../commit/f73fc2a) - __(Michael Roterman)__ Expanding the test suite
 * [31e605e](../../commit/31e605e) - __(Michael Roterman)__ Update .gitignore
 * [c8f8ca3](../../commit/c8f8ca3) - __(Michael Roterman)__ Adding e-mail to composer.json
 * [5a9350f](../../commit/5a9350f) - __(Michael Roterman)__ Add phpunit for dev dependency
 * [373b7c3](../../commit/373b7c3) - __(Michael Roterman)__ Adding more keywords to composer.json
 * [44d077f](../../commit/44d077f) - __(Michael Roterman)__ Formatting more
 * [1ce441a](../../commit/1ce441a) - __(Michael Roterman)__ Formatting
 * [d4389b3](../../commit/d4389b3) - __(Michael Roterman)__ Updating README with additional badges.
 * [53cf259](../../commit/53cf259) - __(Michael Roterman)__ Adding more tests
 * [a970b51](../../commit/a970b51) - __(Michael Roterman)__ Updating tests
 * [21ef258](../../commit/21ef258) - __(Michael Roterman)__ Updating tests
 * [5a7be3a](../../commit/5a7be3a) - __(Michael Roterman)__ Updating unit tests
 * [0a174ac](../../commit/0a174ac) - __(Michael Roterman)__ Fixing CollectionRepositoryTest
 * [9add642](../../commit/9add642) - __(Michael Roterman)__ Adding unit tests
 * [74c4bd7](../../commit/74c4bd7) - __(Michael Roterman)__ Updating phpunit.xml.dist for code coverage
 * [61694cb](../../commit/61694cb) - __(Michael Roterman)__ Updating gitignore to ignore code coverage
 * [3316b59](../../commit/3316b59) - __(Michael Roterman)__ Clean up all files and style.
 * [2f6da48](../../commit/2f6da48) - __(Michael Roterman)__ Removing static methods to allow for easier testing later on.
 * [2d5a111](../../commit/2d5a111) - __(Michael Roterman)__ Updating README
 * [80a168c](../../commit/80a168c) - __(Michael Roterman)__ Cleaning up
 * [4164986](../../commit/4164986) - __(Michael Roterman)__ Allow scrutinizer to bash my head in the Model namespace.
 * [1013045](../../commit/1013045) - __(Michael Roterman)__ Cleanup
 * [7a2e0ae](../../commit/7a2e0ae) - __(Michael Roterman)__ Fixing docblocks
 * [608bd93](../../commit/608bd93) - __(Michael Roterman)__ Fixing some issues indicated by Scrutinizer
 * [59a0591](../../commit/59a0591) - __(Michael Roterman)__ Removing all expectations of how non implemented methods should be implemented by collaborators.
 * [5f3dc67](../../commit/5f3dc67) - __(Michael Roterman)__ Fixing docblocks / use statements.
 * [60961bc](../../commit/60961bc) - __(Michael Roterman)__ Update method
 * [2fdb933](../../commit/2fdb933) - __(Michael Roterman)__ Adding inline docblocks to assign the Response object properly for IDE's.
 * [8661182](../../commit/8661182) - __(Michael Roterman)__ Updating README
 * [07d0f30](../../commit/07d0f30) - __(Michael Roterman)__ Adding scrutinizer configuration.
 * [cb91d59](../../commit/cb91d59) - __(Michael Roterman)__ Adding travis configuration.
 * [f5f14c8](../../commit/f5f14c8) - __(Michael Roterman)__ Adding changes influenced by tests.
 * [a3980c9](../../commit/a3980c9) - __(Michael Roterman)__ Adding tests for the API namespace.
 * [38450c0](../../commit/38450c0) - __(Michael Roterman)__ Adding basic tests for movies
 * [f0fc9d1](../../commit/f0fc9d1) - __(Michael Roterman)__ Add non implemented methods with the expection to fail for now.
 * [22cf331](../../commit/22cf331) - __(Michael Roterman)__ Adding tests for Api\Movies
 * [d43d291](../../commit/d43d291) - __(Michael Roterman)__ Updating Models
 * [deab27c](../../commit/deab27c) - __(Michael Roterman)__ Fixing the rest
 * [4e1b58b](../../commit/4e1b58b) - __(Michael Roterman)__ Correction
 * [35a680b](../../commit/35a680b) - __(Michael Roterman)__ Updating docs and adding scrutinizer config
 * [02ca249](../../commit/02ca249) - __(Michael Roterman)__ Updating docblocks to help IDE auto-completion
 * [a0fa24a](../../commit/a0fa24a) - __(Michael Roterman)__ Clean up the Genre API
 * [f548710](../../commit/f548710) - __(Michael Roterman)__ Adding find classes, needs further inspection.
 * [5c5251c](../../commit/5c5251c) - __(Michael Roterman)__ Making sure depdendencies are met for the request
 * [811b68c](../../commit/811b68c) - __(Michael Roterman)__ Adding the Discover API
 * [07e8235](../../commit/07e8235) - __(Michael Roterman)__ Adding configuration example
 * [f0c8d1d](../../commit/f0c8d1d) - __(Michael Roterman)__ Adding company example
 * [dca8277](../../commit/dca8277) - __(Michael Roterman)__ Adding Changes API section, added Query object to support this behaviour.
 * [3a6ce54](../../commit/3a6ce54) - __(Michael Roterman)__ Adding the implementation of Collection, this caused some disturbance and decided to rename the generic collection object to GenericCollection to avoid confusion with the Collection api method
 * [d344358](../../commit/d344358) - __(Michael Roterman)__ Updating README to reflect latest change to support https
 * [d40f4f8](../../commit/d40f4f8) - __(Michael Roterman)__ Updating README to reflect latest change to support https
 * [7d0aa6c](../../commit/7d0aa6c) - __(Michael Roterman)__ Cutting off the Guzzle Collection dependency, and made sure to credit the author for some parts we still use.
 * [9920fa6](../../commit/9920fa6) - __(Michael Roterman)__ Adding secure schema support, and removing un-used options support.
 * [a5a61ce](../../commit/a5a61ce) - __(Michael Roterman)__ Fix naming conventions
 * [207e403](../../commit/207e403) - __(Michael Roterman)__ Small updates
 * [7fd7485](../../commit/7fd7485) - __(Michael Roterman)__ Updating docs
 * [bae65e9](../../commit/bae65e9) - __(Michael Roterman)__ Implementing interfaces to indicate filter support on the various models
 * [0070d2f](../../commit/0070d2f) - __(Michael Roterman)__ Adding generic and image related collection filters
 * [27ef5db](../../commit/27ef5db) - __(Michael Roterman)__ Expanding the Factories to better support Image generation and adding properties to the relative objects to provide this functionality ( e.g. posterPath has a cousin poster now which holds a true Image object ).
 * [850977d](../../commit/850977d) - __(Michael Roterman)__ Remove history
 * [57ebfdd](../../commit/57ebfdd) - __(Michael Roterman)__ Adding Donation button and small cleanups
 * [f21b2e8](../../commit/f21b2e8) - __(Michael Roterman)__ Update the readme file
 * [2789ad4](../../commit/2789ad4) - __(Michael Roterman)__ Cleaning up API namespace
 * [5bb3e2f](../../commit/5bb3e2f) - __(Michael Roterman)__ Expanding the API
 * [2c6d85b](../../commit/2c6d85b) - __(Michael Roterman)__ Updating examples
 * [53b2fb0](../../commit/53b2fb0) - __(Michael Roterman)__ Refactoring API namespace and expanding the Model namespace.

- Adding $headers parameter to all API methods
- Modified client class, remove the api() method
- Adding repositories
- Cleaning up model classes

 * [c3926cc](../../commit/c3926cc) - __(Michael Roterman)__ Adding first state of config with simple use case of the image helper

Conflicts:
	examples/movies/model/get.php
	lib/Tmdb/Factory/GenreFactory.php
	lib/Tmdb/Factory/MovieFactory.php
	lib/Tmdb/Model/Common/DataCollector.php

 * [de17a90](../../commit/de17a90) - __(Michael Roterman)__ Updating Model structure
 * [f26bb3e](../../commit/f26bb3e) - __(Michael Roterman)__ Refacotring dates in releases
 * [146249e](../../commit/146249e) - __(Michael Roterman)__ Making sure people won't use this for production usages yet as we have to refactor the API section slightly ( but will have a big impact on anyone using it ).
 * [b530d08](../../commit/b530d08) - __(Michael Roterman)__ Updating README
 * [f067911](../../commit/f067911) - __(Michael Roterman)__ Refactoring the models big-time

- Removed any knowledge of collaborators from the models.
- Added factories to create the models by the retrieved data from the API.
- Added a Movie repository that is able to load an movie providing the client and id ( by calling the API segment and passing the data on to the factory ).
- Starting to refactor some bits of the API segment, removing the ->api() function call in the client. ( For now I just added getMovieApi(), but the whole api() method will vanish ).
- Added a GenericCollectionFactory to create collections of objects we don't care much about (yet) to filter or ...?
- Created some extra submodels for Movies

 * [9859dbd](../../commit/9859dbd) - __(Michael Roterman)__ Refactoring more factory stuff, more or less completed the ImageFactory from a Movie point of view
 * [c02ce9d](../../commit/c02ce9d) - __(Michael Roterman)__ Creating more abstraction, Movie Model is completely stand-alone now.
 * [3a32c4c](../../commit/3a32c4c) - __(Michael Roterman)__ DOCBlock round...
 * [d3dcb9e](../../commit/d3dcb9e) - __(Michael Roterman)__ Refactoring API, moving stuff up to factories
 * [5c90abe](../../commit/5c90abe) - __(Michael Roterman)__ Making a start of moving the ugly fromArray methods to dedicated Factories
 * [5edf3ed](../../commit/5edf3ed) - __(Michael Roterman)__ Making a start of moving the ugly fromArray methods to dedicated Factories
 * [3a07da7](../../commit/3a07da7) - __(Michael Roterman)__ Adding bin/ to gitignore
 * [8d126cd](../../commit/8d126cd) - __(Michael Roterman)__ Expanding models
 * [f9ca4a4](../../commit/f9ca4a4) - __(Michael Roterman)__ Renaming internal variables
 * [7fbcb2e](../../commit/7fbcb2e) - __(Michael Roterman)__ Updating PHP DocBlocks for Movies, make sure all properties are marked with their respective types.
 * [3ce13f6](../../commit/3ce13f6) - __(Michael Roterman)__ Splitting up Tv into Tv, TvSeason and TvEpisode
 * [0812794](../../commit/0812794) - __(Michael Roterman)__ - Refactoring collection locations to be more natural - Adding query parameter bags to provide a decent API to all possible query parameters
 * [54128dc](../../commit/54128dc) - __(Michael Roterman)__ Updating README
 * [d570484](../../commit/d570484) - __(Michael Roterman)__ Fixing README

Conflicts:
	README.md

 * [b90a2a6](../../commit/b90a2a6) - __(Michael Roterman)__ Updating README with proper sources.
 * [bcd7274](../../commit/bcd7274) - __(Michael Roterman)__ Updating README with proper sources.
 * [5d41529](../../commit/5d41529) - __(Michael Roterman)__ Updating README
 * [37a2c6c](../../commit/37a2c6c) - __(Michael Roterman)__ Adding a short explanation of the current state of the project
 * [5b5f5b7](../../commit/5b5f5b7) - __(Michael Roterman)__ Removing API key
 * [9e4da64](../../commit/9e4da64) - __(Michael Roterman)__ Re-adding apikey.php to .gitignore
 * [729eb7c](../../commit/729eb7c) - __(Michael Roterman)__ Adding some examples and a base apikey.php file to run the examples.
 * [74aa949](../../commit/74aa949) - __(Michael Roterman)__ Replacing the TMDB url to the proper one
 * [e249d56](../../commit/e249d56) - __(Michael Roterman)__ Updated images with a new found format, and preparing to move any "query" type of down to the "Query" namespace as this seems more logical.
 * [6cf99a4](../../commit/6cf99a4) - __(Michael Roterman)__ Patched up changes
 * [1700035](../../commit/1700035) - __(Michael Roterman)__ Adding getId to the Person Interface to make sure it is always compatible.
 * [df7ef20](../../commit/df7ef20) - __(Michael Roterman)__ Cleaning up inheritance
 * [ae365f5](../../commit/ae365f5) - __(Michael Roterman)__ Extending the Movies model
 * [02693b1](../../commit/02693b1) - __(Michael Roterman)__ Extending more models and creating some more "logical" approaches to different type of people (person).

- Updated Genres, added a filter capability.

 * [14a13d3](../../commit/14a13d3) - __(Michael Roterman)__ Added most of the API functionality, except for anything that requries sessions, such as the accounts and lists etc.
 * [0d4e0d7](../../commit/0d4e0d7) - __(Michael Roterman)__ Initial base commit

- Already finished up all basic API methods for movies

 * [710fa72](../../commit/710fa72) - __(Michael Roterman)__ Adding .gitignore
