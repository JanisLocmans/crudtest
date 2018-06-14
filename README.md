# CRUD & REST Test/Practice

# Available endpoints for posts: 
# */api/notes [POST] notes.store header json
# */api/notes  [Get] notes.index
# */api/notes?user={id}  [Get] notes.index

# Available user Commands:
#  user:create         expected user:create {name}
#  user:destroy        expected user:destroy {id}
#  user:read           expected user:read !!Optional user:read {id?} to retrieve specific user!!
#  user:update         expected user:update {id} {name}
# Available UnitTests:
# * ToCheck JSON string compability.
  
# Sampe JSON for testing: 
{
	"posts": [{
		"user_id" : 1,
		"title" : "post1",
		"content" : "sadsetest"
	},
	{
		"user_id" : 1,
		"title" : "post2",
		"content" : "someasdst"
	},
	{
		"user_id" : 1,
		"title" : "post3",
		"content" : "sodasest"
	},
	{
		"user_id" : 2,
		"title" : "post4",
		"content" : "sodasest"
	},
	{
		"user_id" : 2,
		"title" : "post5",
		"content" : "somasdst"
	},
	{
		"user_id" : 3,
		"title" : "post6",
		"content" : "sdsast"
	},
	{
		"user_id" : 999,
		"title" : "post7",
		"content" : "tas"
	}
	]
}
