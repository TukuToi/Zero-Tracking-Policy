# TukuToi Zero Tracking Policy

*Note: this project is under development and we highly appreciate feedback and contributions to the GitHub Project*

**The Problem**

Thousands (millions) of World Wide Web users visit daily thousands (millions?) of Websites, which more often than not employ some sort of tracking, cookies, sniffing or else "analysis" of their Website Visitors. This data is usually gathered off-site, thru Google or Facebook or other services, and then analysed by the Webmaster. This data however is mostly the Visitors Private Concern, which is why GDPR was instantiated, forcing many Websites to ask the Visitor if they are fine with their data being tracked, or not.

This has brought some major issues with it:
- it is annooying 
==> because of the requirement to go thru legal statements and accept/deny things *before* we can read content
- it is useless 
==> because it legalises data theft, for example, if the user is mislead or by mistake allows the wrong option, *nothing* can now legally stop the webmaster or data collector to do whatever was agreed to by the user, with the data.
- it creates a two-classess-society
==> because basically, if I am not willing to let a website snoop my data, I am not allowed to get news, information or else data stored online, this is what it boils down to: give us your data or we give you no information.

The situation (privacy infringements, data selling, data analysys and worse things like FLoC) has NOT improved with GDPR. It has worsened, and left the legal side without any power of action because now everything is "accepted by the user". 
But, do not take our word for it. You can [Read Online](https://www.theguardian.com/commentisfree/2019/nov/10/these-new-rules-were-meant-to-protect-our-privacy-they-dont-work) several [articles](https://insightsoftware.com/blog/gdpr-the-good-the-bad-the-ugly/) (after you accept their cookies 🍭) discussing this matter too.

**The Solution**

We believe that the Webmaster, or in other words, the one who collects the data is responsible for this, it is and shall not be on the user. 
Externalizing the responsibility to the user by making them choose (or excluding them if they dont choose) what to agree to and what not, is wrong, because many users wont even understand what they agree to (or not).
The right thing to do is stop attempting to "steal" those users data. It is not ours (webmasters) to start with, and we will not gain much by "having it"

The right approach is to respect the users privacy and not just to state so, so to later make them agree to share everythign they own online with us.

The right thing to do is not to employ trackers, cookies, mailing lists, and other data gethering tools on our websites.
There are many Webmasters actively doing so, even storing fonts on their own servers to avoid any snooping (for example by Adobe Fonts), they do not engage in Analytics and even store videos themselves to avoid external storage providers snoop their visitors.

These developers and webmasters do not have any way to get "recompensed" or to communicate their "clean" approach, other than writing a policy on their website which then by the user is interpreted as "they forgot to add the cookie consent" and wont be read anytime

So, a Policy should be created, with a Badge, and a "contract" that is as widely accepted and known as the green padlock of HTTPS. NO user (visitor) interaction shall be required, instead, the Webmaster shall be responsible to have and provide "clean" sites. A badge, as prooposed in this project, should inform the visitor that this site follows the proposed piolicy and that *no data is tracked* when they visit this site. This, without any action required, and with a guaranteed security.

**The Policy**

1. The Privacy of Website Visitors and generally users of the World Wide Web is a fundamental Right.
2. Every action taken by any World Wide Web user in any online instance is the users Private Concern.
3. Any data communicated by the client, in any form, is the users Private Property.
4. The Website or Webmaster does not track, register, detect or else spy on the user and their activities.
5. The Website or Webmaster does not engage in any form of tracking or analysis of the user's data.
6. The Website or Webmaster does not employ any form of tracking software, including but not limited to Google Analytics, Facebook Analytics, Plausible.io, SemRush, or any other form of analysis involving user data such as cookies, beacons, or else.
7. The Website or Webmaster does by their knowledge the best to protect the user from Security and Data breaches, be it on The Website or Affiliated Instances, or else connected services.
8. The Website or Webmaster transparently communicates to the visitors in a Privacy Policy what data is registered, if any, and what actions the visitor can take to remove this data, if any. 
9. The Website or Webmaster communicates to the visitors what happens with the data tracked, if any, and why specific data is collected.
10. The Website or Webmaster does not maintain a "Email List" or else list of their visitors, unless clearly agreed upon by the visitor, nor are online decisions of the user collected.

# Zero-Tracking-Policy Badge Specs

- The Fill Color of the Badge must be `#2e7ba5` or `#ffffff`.
- The Badge cannot be altered from its current look.
- Include the badge anywhere you want on your website, once or repeatedly.
- Download, include, copy, paste the 10 points TukuToi Zero Tracking Policy where and how you want, as long it is not altered.
- Do link the Badge to either this GitHub Repo, _or_ the original Policy at https://www.tukutoi.com/tukutoi-zero-tracking-policy/ _unless_ you include the Policy on your project, then you may link to that page instead.
- The easiest way to include the badge site wide using Bootstrap woudl be something like this:

```
<style>
.zero-tracking-policy-badge{
  position: fixed;
  bottom: 0px;
  left: 0px;
}
</style>
<div class="container ">
  <div class="row ">
    <div class="col-md-1 zero-tracking-policy-badge">
      <p>
        <a href="https://www.tukutoi.com/tukutoi-zero-tracking-policy/">
          <img loading="lazy" src="./img/zero-tracking.png" width="34" height="39" class="aligncenter size-full img-fluid">
        </a>
      </p>
    </div>
  </div>
</div>
```

# Websites adhering and using the TukuToi Zero Tracking Policy
*Note, this list is completely voluntary and not result of a tracking proces, of course*

1. [TukuToi](https://www.tukutoi.com/)
2. [HumanOfEarth](https://www.humanofearth.com/)
3. [Undenk](https://www.undenk.info/)
