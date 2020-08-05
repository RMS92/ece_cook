theme: https://wordpress.com/theme/appetite/setup
set COMPOSER_MEMORY_LIMIT=-1

Recipe
-title / string
-caption /text
-description / text
-difficulty / float
-duration / int
-categories / relation / many-to-one -> category
-comments / relation / one-to-many -> comment
-author / relation / many-to-one -> user
-pictures / relation / one-to-many -> recipe_picture
-created-at / datetime
-updated_at / datetime
-active / boolean
A RAJOUTER -active / boolean

Recipe_picture
-filename / string

Comment
-content / text
-children / one-to-many / self
-updated_at / datetime
-created_at / datetime
-active / boolean

Category
-title
-filename / string 
-updated_at / datetime
-created_at /datetime


Event
-title / string
-caption /text
-description / text
-city
-address
-postal_code
-lat /float
-lng /float
-pictures / relation / one-to-many -> event_picture
-takesPlace_at / datetime
-created_at / datetime
-updated_at / datetime
-active / boolean

Event_picture
-filename / string

Article
-title /string 
-caption / text 
-description / text
-pictures / relation / one-to-many -> article_picture
-created_at / datetime
-updated_at / datetime

Article_picture
-filename /string

User
-username / string
-email / string
-firstname / string
-lastname / string
-password / string
-function / string
-role / string
-filename / string
-created_at / datetime
-updated_at / datetime