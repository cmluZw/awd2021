#!/usr/bin/python

import sys
import os


def copy_team(web_name,team_no):

    content='cp -r /home/wwwroot/default/awd-lastest/docker/%s team_%d'%(web_name,team_no)
    return content



def create_docker_sh(team_no,team_web_name):
    content = """
    docker run -p %d:80  -p %d:22 -v /home/wwwroot/default/awd-lastest/docker/%s:/var/www/html -v /home/wwwroot/default/awd-lastest/docker/d7297256b8cf26ab/Team_F1AG_%d:/flag -d  --name team%d -it awd-lastest /run.sh
    """% (8080 + team_no, 2200 + team_no,team_web_name,team_no,team_no)
    return content

def start_game():
    os.system('sh /home/wwwroot/default/awd-lastest/docker/docker.sh')

def write_flag():
    flag_arr=[]
    f = open("flag1.txt")
    flag_arr=f.readlines()
    # print flag_arr
    i=1
    for line in flag_arr:
        with open("team_%d/flag.php"%(i),"a") as f2:
            f2.write(line)
        i=i+1

def copy_team():
    os.system('sh /home/wwwroot/default/awd-lastest/docker/cp.sh')

def main():
    team_num = int(sys.argv[1])
    web_name =str(sys.argv[2])
    end_time=int(sys.argv[3])
    for i in range(team_num):
        open('cp.sh','a').write(copy_team(web_name,i+1)+'\n')
        open('docker.sh','a').write(create_docker_sh(i+1,"team_"+str(i+1))+'\n')
    start_game()
    copy_team()

if __name__ == '__main__':
	main()