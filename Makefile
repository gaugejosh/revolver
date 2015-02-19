#
# About
# --------------------------------------------------
# This script can:
# - Install WordPress

#
# How to use
# --------------------------------------------------
# Run
# $ make                    -- Compile CSS
# $ make theme-css          -- Compile CSS
# $ make magento            -- Install Magento
# $ make wordpress          -- Install WordPress

# WordPress
WORDPRESS_LATEST  = http://wordpress.org/latest.tar.gz

#
# Install WordPress
# -------------------------

wordpress:
	@printf "Downloading WordPress...\n"
	@wget ${WORDPRESS_LATEST}
	@printf "Extracting...\n"
	@tar -xzf latest.tar.gz
	@printf "Moving into current directory...\n"
	@cp -R wordpress/* .
	@printf "Tidying things up...\n"
	@rm -rf latest.tar.gz wordpress
	@printf "All done!\n"