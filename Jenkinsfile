node {
 	// Clean workspace before doing anything
    sh "sudo chmod 777 -R /var/lib/jenkins/workspace/SA-Proyecto"
    deleteDir()

    try {
        stage ('Clone') {
        	checkout scm
        }
        stage ('Build') {
		sh "echo 'shell scripts to deploy to server....'"
            sh "sudo composer install -d /var/lib/jenkins/workspace/SA-Proyecto/"
        }
	stage ('Push') {
		sh "echo 'shell scripts to deploy to server...'"
      	}
        stage ('Tests') {
	        sh "echo 'shell scripts to deploy to server....'"
	        sh "echo 'shell scripts to deploy to server....'"
            sh 'sudo /var/lib/jenkins/workspace/SA-Proyecto/vendor/bin/phpunit'
            sh 'sudo ab -k -n1000 -c100 -H "Accept-Encoding: gzip,deflate" http://104.196.194.35/api/v1/dptos'
        }   
      	stage ('Deploy') {
            sh "sudo rm -rf /var/www/html/SA-Proyecto"
            sh "sudo cp -R /var/lib/jenkins/workspace/SA-Proyecto/ /var/www/html/"
            sh "sudo chgrp -R www-data /var/www/html/SA-Proyecto"
            sh "sudo chmod -R 775 /var/www/html/SA-Proyecto/storage"
            //sh "sudo composer install -d /var/www/html/SA-Proyecto"
            //sh "sudo mkdir /var/lib/jenkins/workspace/SA-Proyecto"
      	}
    } catch (err) {
        currentBuild.result = 'FAILED'
        throw err
    }
}
