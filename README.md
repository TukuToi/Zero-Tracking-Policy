# TukuToi Zero Tracking Policy

The TukuToi Zero Tracking Policy is a blockchain based Privacy and Tracking Policy for Websites. 

Thepolicy enacts a contract between Web Users and Web Masters, where the Web Masters agree to respect the Web Users privacy, and the Web Users can verify this contract, enforece it and invalidate it. 
Since the Zero Tracking Policy is based on blockchain technology, it impossible to ever tamper with the ledger of verifications.

## How does it work

The Webmaster who intends to provide a browsing experience respecting the Contract (see "Contract" section below),
will submit their domain to the Network for verification.
This works by POSTing the domain to any of the available nodes.
The nodes then pick up the domain (as "pending verification") and first verifies that the domain submitted is online, has a valid DNS and thus is a real website.

Passed this test, the domain owner or any one else can add the domain to the blockchain as verified.

From this point on, the domain will be part of the TukuToi Zero Tracking Policy, immutably, and forever.
The domain at this point will be part of the chain as a block with this example structure:

 ----------------------
| index               3| // Describes the Index of this block in the chain
 ----------------------
| timestamp  1657183515| // Describes an UNIX Timestamp when this block was added to the chain
 ----------------------
| proof           48245| // Describes the value required to generate the Hash based on the deifficulty (4)
 ----------------------
| previous_hash 31[.]59| // Describes the previous block hash ([.] is a placeholder for a much larger SHA256 Hash)
 ----------------------
| domain     domain.tld| // Describes the Domain (Website) added
 ----------------------
| confirmations       1| // Describes the number of confirmations this website received 
 ----------------------

Anyone now can see in the blockchain this Domain has been verified, and it has received one confirmation to uphold the Contract: The owner's own confirmation. We can understand this block as the "signature" on the contract.

From this point on Web Users in general are able to _confirm_ the Contract is upheld by its owner by re-confirming the Domain.
What this does, is adding another block to the chain, with with the same value in `domain`, however new index, timestamp, proof, hash and `confirmations` gets updated by 1 (all previous confirmations + 1)

This way, we can ensure a couple things:
- if a WebMaster signs up to the policy, they cannot retreat from it. The domain is immutably signed to the Contract, with at least one confirmation: The Domain owner's "signature".
- if a Webmaster cheats, Web Users can express this by warning the network through a "de-confirmation", or "downvote" of the Domain. This happens just like when re-verifiying the Domain, through a new block, but this time, the confirmations will become -1 from the total.
- The _original_ Contract can never be destroyed, altered, or get lost, because it is part of the blockchain: in fact, it is incorporated in the Genesis Block (first block in the chain) as the "domain", in a base64 encoded string, for everyone to read.

## The Contract

1. The Privacy of Website Visitors and generally users of the World Wide Web is a fundamental Right.
2. Every action taken by any World Wide Web user in any online instance is the user's Private Concern.
3. Any data communicated by the client, in any form, is the user's Private Property.
4. The Website or Webmaster does not track, register, detect or else spy on the user and their activities.
5. The Website or Webmaster does not engage in any form of tracking or analysis of the user’s data.
6. The Website or Webmaster does not employ any form of tracking software, including but not limited to Google Analytics, Facebook Analytics, Plausible.io, SemRush, or any other form of analysis involving user data such as cookies, beacons, or else.
7. The Website or Webmaster does by their knowledge the best to protect the user from Security and Data breaches, be it on The Website or Affiliated Instances, or else connected services.
8. The Website or Webmaster transparently communicates to the visitors in a Privacy Policy what data is registered, if any, and what actions the visitor can take to remove this data, if any.
9. The Website or Webmaster communicates to the visitors what happens with the data tracked, if any, and why specific data is collected.
10. The Website or Webmaster does not maintain a “Email List” or else list of their visitors, unless clearly agreed upon by the visitor, nor are online decisions of the user collected.

# To Do
- an automated generation of badge should be implemented, possibly with a QR code
- it should be avoided that users can verify domains repeatedly (or un-verify) either over a certain amount of time, or ever
- the contract, being immutable, has to be pedantically reviewed
- logic to keep track of pending domains has to be partially reviewed, and partially extended
- logic to un-verify a domain has to be implemented
