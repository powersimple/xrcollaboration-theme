function loadActiveProfile(id) {
    var this_profile = profile_posts[id]
    console.log("profile-posts", profile_posts[id], filter_posts[id])
        /* LOGO */
    var logo = '<img src="' + filter_posts[id].logo + '" alt="' + this_profile.info.company + ' logo">'
    $('#profile-template .profile-logo').html(logo);

    /* COMPANY */
    $('#profile-template .solution_name h4').html(this_profile.info.solution_name);

    /* SOLUTION NAME */
    $('#profile-template .company h5').html("by: " + this_profile.info.company);

    /* EXCERPT */
    $('#profile-template .blurb').html(profile_posts[id].excerpt.rendered);
    /* Use Cases */
    var use_cases = profile_posts[id].info.use_cases
    if (use_cases.length > 200) {
        use_cases = use_cases.substring(0, 200);
    }

    $('#profile-template .use-cases').html(use_cases + " <a href='" + filter_posts[id].route + "'>more..</a>")


    /*TAGS*/
    var profile_hardware = getProfileTags('Hardware', hardware_posts, this_profile.support_hardware, 'hardware')

    var profile_platform = getProfileTags('Platforms', taxonomies.platform, this_profile.platform, 'platform')

    var profile_industry = getProfileTags('Industries', taxonomies.industry, this_profile.industry, 'industry')

    var profile_feature = getProfileTags('Features', taxonomies.feature, this_profile.feature, 'feature')

    var profile_collaboration_type = getProfileTags('Collaboration Types', taxonomies.collaboration_type, this_profile.collaboration_type, 'collaboration_type')

    var profile_link = '<a href="' + filter_posts[id].route + '" class="profile-link" title="View the full profile of ' + this_profile.info.company + '">For more information on ' + this_profile.info.company + '<br>View their full XR Collaboration Profile</a>'

    $('#profile-template .view-profile').html(profile_link);
    var template = jQuery('#profile-template').html();

    /* INJECTION */
    $('#active-profile').html(template)

}

function getProfileTags(label, tag_data, tags, el) {
    console.log(label, tags, el)
    var profile_tag_labels = []
    console.log(tag_data)

    if (tags.length > 0) {

        for (var t = 0; t < tags.length; t++) {

            profile_tag_labels.push(tag_data[tags[t]].name);
            //   profile_tag_labels.push(hardware_posts[t].title.rendered)
        }
        console.log(label + " tags", profile_tag_labels.join(","))
        var element = '#profile-template .' + el
        $(element).html("<span class='filter-type'>" + label + ":</span> " + profile_tag_labels.join(", "));

    } else {
        $('#profile-template .' + el).css("display:none")
    }
}