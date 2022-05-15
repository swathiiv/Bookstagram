import sys
import tweepy

CONSUMER_KEY = 'KTEPSAyhEhgowrLoIVnZH8Flv'
CONSUMER_SECRET = 'H6WN3gNkRZFEhApWv1ekLVAdKCWHlzxtIOvfKXYVoniNtxbNK7'
OAUTH_TOKEN='1177594936343941120-SHXVA9OQlvXzQ5pVC9FPEhcqBzU8yR'
OAUTH_TOKEN_SECRET='tQVD2MdIJ8Xp1L24HENViLXMmcZUfS5cPCkYpq9iLuFAJ'
# authentication of consumer key and secret
auth = tweepy.OAuthHandler(CONSUMER_KEY, CONSUMER_SECRET)
# authentication of access token and secret
auth.set_access_token(OAUTH_TOKEN, OAUTH_TOKEN_SECRET)
api = tweepy.API(auth)
# update the status
name = sys.argv[1]
api.update_status(status=name)





