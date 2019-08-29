## about

 This script is a simple filtering solution for command line, as I haven't found 
 anything similar with 5 min googleing. Reads from `stdin`, outputs to `stdout`.
 Errors will be printed to `stderr`.
 
## install
 ```bash
$ composer global require technodelight/fuse-cli
 ```
 
## usage

 Filter lists simply.
 
 ```bash
 $ echo -e "house\ntrance\ntechno" | fuse ho 
 # // this puts the following to stdout: 
 # house
 # techno
 ```

 options:
 - `-q`: quiet mode (exit 0 on match, exit 1 on no match)
 ```bash
 echo -e "house\ntrance\ntechno" | fuse trz -q && echo yep || echo nope # outputs: yep 
 ```
 - `-t[float]`: set threshold (defaults to 0.4 for a more exact match)
 ```bash
 echo -e "house\ntrance\ntechno" | fuse trz # outputs: trance
 echo -e "house\ntrance\ntechno" | fuse trz -t0.8 # outputs: trance, techno
 ```
