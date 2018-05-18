
Installation
============

1. Install virtual box + vagrant + plugins
2. Clone repo
3. Run vagrant up
    - There will be a Elastic Service running in this terminal. Leave it open
4. vagrant ssh
5. cd /srv/www/
6. composer install
7. Add new entry to /etc/hosts file 
    - 10.1.1.33 learnhub

LearnHub
===========

A Symfony project created on March 1, 2016, 3:00 pm.

##Rate power function

###Assumptions

- *Moderator* as U*m*, G(rating constant) = 5
- *User type 3* as U*3*, G = 4
- *User type 2* as U*2*, G = 3
- *User type 1* as U*1*, G = 2
- *User type 0* as U*0*, G = 1
- Rank overall as R*o*
- Detailed category rank as *CatRank*

###Rate Strenght

S = *CatRank* * G + R*o*

##TODO

- move bundles into one dir
- list controls: **watched**
- list controls: **vote as relevant**
- list controls: **tags suggestions**
- list controls: **category suggestions**
- url shortener